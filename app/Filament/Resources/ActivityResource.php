<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Livewire\Component as Livewire;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;
use Rmsramos\Activitylog\Resources\ActivitylogResource;
use stdClass;

class ActivityResource extends ActivitylogResource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $slug = '/activity/log';

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.activity');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.activity');
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('causer_id')
                            ->afterStateHydrated(function ($component, ?Model $record) {
                                return $component->state($record->causer?->name);
                            })
                            ->label(__('activitylog::forms.fields.causer.label')),

                        TextInput::make('subject_type')
                            ->formatStateUsing(function ($state, Model $record) {
                                if (! $state) {
                                    return '-';
                                }
        
                                return __('activity.' . strtolower(Str::of($state)->afterLast('\\'))) . ' #' . $record->subject_id;
                            })
                            ->label(__('activitylog::forms.fields.subject_type.label')),

                        Textarea::make('description')
                            ->label(__('activitylog::forms.fields.description.label'))
                            ->formatStateUsing(fn ($state) => __('activity.' . $state))
                            ->rows(2)
                            ->columnSpan('full'),
                    ]),
                    Section::make([
                        Placeholder::make('event')
                            ->content(function (?Model $record): string {
                                return $record?->event ? __('activity.' . strtolower(ucwords($record?->event))) : '-';
                            })
                            ->label(__('activitylog::forms.fields.event.label')),

                        Placeholder::make('created_at')
                            ->label(__('activitylog::forms.fields.created_at.label'))
                            ->content(function (?Model $record): string {
                                return $record->created_at ? "{$record->created_at->format(config('filament-activitylog.datetime_format', 'd/m/Y H:i:s'))}" : '-';
                            }),
                    ])->grow(false),
                ])->from('md'),

                Section::make()
                    ->columns()
                    ->visible(fn ($record) => $record->properties?->count() > 0)
                    ->schema(function (?Model $record) {
                        $properties = $record->properties->except(['attributes', 'old']);

                        $schema = [];

                        if ($properties->count()) {
                            $schema[] = KeyValue::make('properties')
                                ->label(__('activitylog::forms.fields.properties.label'))
                                ->columnSpan('full');
                        }

                        if ($old = $record->properties->get('old')) {
                            $schema[] = KeyValue::make('old')
                                ->formatStateUsing(fn () => self::formatDateValues($old))
                                ->label(__('activitylog::forms.fields.old.label'));
                        }

                        if ($attributes = $record->properties->get('attributes')) {
                            $schema[] = KeyValue::make('attributes')
                                ->formatStateUsing(fn () => self::formatDateValues($attributes))
                                ->label(__('activitylog::forms.fields.attributes.label'));
                        }

                        return $schema;
                    }),
            ])->columns(1);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function table(Table $table): Table
    {
        $events = [];

        foreach (static::getModel()::distinct()->pluck('event', 'event')->filter() as $key => $value) {
            $events[$key] = __('activity.' . $value);
        }

        return $table
            ->columns([
                TextColumn::make('#')->state(
                    static function (HasTable $livewire, stdClass $rowLoop) {
                        if (isset($rowLoop->iteration)) {
                            return (string) (
                                $rowLoop->iteration + ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1))
                            );
                        }
                    }
                ),
                TextColumn::make('event')
                    ->formatStateUsing(fn ($state) => __('activity.' . $state))
                    ->badge()
                    ->label(__('activity.event'))
                    ->color(fn (string $state): string => match ($state) {
                        'draft'   => 'gray',
                        'updated' => 'warning',
                        'created' => 'success',
                        'deleted' => 'danger',
                        default   => 'primary',
                    })
                    ->searchable(),

                TextColumn::make('subject_type')
                    ->label(__('activity.record'))
                    ->formatStateUsing(function ($state, Model $record) {
                        if (! $state) {
                            return '-';
                        }

                        return __('activity.' . strtolower(Str::of($state)->afterLast('\\'))) . ' #' . $record->subject_id;
                    })
                    ->searchable()
                    ->hidden(fn (Livewire $livewire) => $livewire instanceof ActivitylogRelationManager),
                    
                TextColumn::make('causer.name')
                    ->label(__('activity.user'))
                    ->getStateUsing(function (Model $record) {
                        if ($record->causer_id == null || $record->causer == null) {
                            return new HtmlString('&mdash;');
                        }
                        
                        return $record->causer->name;
                    })
                    ->searchable(),

                static::getPropertiesColumnComponent(),
                
                TextColumn::make('created_at')
                    ->label(__('activity.date'))
                    ->formatStateUsing(fn ($record) => date_format(date_create($record['created_at']), 'd/m/Y h:ia'))
                    ->searchable()
                    ->sortable()
            ])
            ->defaultSort(
                config('filament-activitylog.resources.default_sort_column', 'created_at'),
                config('filament-activitylog.resources.default_sort_direction', 'asc')
            )
            ->filters([
                static::getDateFilterComponent(),
                SelectFilter::make('event')
                    ->label(__('activitylog::tables.filters.event.label'))
                    ->options($events)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'view'  => Pages\ViewActivity::route('/{record}'),
        ];
    }

    private static function formatDateValues(array|string|null $value): array|string|null
    {
        if (is_null($value)) {
            return $value;
        }

        if (is_array($value)) {
            foreach ($value as &$item) {
                $item = self::formatDateValues($item);
            }

            return $value;
        }

        if (is_numeric($value) && ! preg_match('/^\d{10,}$/', $value)) {
            return $value;
        }

        if (self::isValidDate($value)) {
            return Carbon::parse($value)
                ->format(config('filament-activitylog.datetime_format', 'd/m/Y H:i:s'));
        }

        return $value;
    }

    private static function isValidDate(string $dateString, string $dateFormat = 'Y-m-d', string $dateTimeFormat = 'Y-m-d H:i:s'): bool|string
    {
        try {

            $dateTime = CarbonImmutable::createFromFormat($dateFormat, $dateString);

            if ($dateTime && $dateTime->format($dateFormat) === $dateString) {
                return true;
            }

        } catch (InvalidFormatException $e) {

        }

        try {

            $dateTime = CarbonImmutable::createFromFormat($dateTimeFormat, $dateString);

            if ($dateTime && $dateTime->format($dateTimeFormat) === $dateString) {
                return true;
            }

        } catch (InvalidFormatException $e) {

        }

        return false;
    }
}
