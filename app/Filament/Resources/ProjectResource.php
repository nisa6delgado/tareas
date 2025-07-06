<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    public static function getModelLabel(): string
    {
        return __('projects.project');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        $icons = config('icons');
        $icons = array_combine($icons, $icons);

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('projects.name'))
                    ->required()
                    ->autofocus(),

                Forms\Components\Select::make('icon')
                    ->label(__('projects.icon'))
                    ->options($icons)
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('archived')
                    ->label(__('projects.status'))
                    ->options([
                        '0' => __('projects.active'),
                        '1' => __('projects.archived'),
                    ])
                    ->required()
                    ->default(0),

                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('projects.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('icon')
                    ->label(__('projects.icon'))
                    ->icon(fn (string $state): string => match ($state) {
                        $state => 'heroicon-o-' . $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('archived')
                    ->label(__('projects.status'))
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return $state ? __('projects.archived') : __('projects.active');
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'success',
                        '1' => 'warning',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        '0' => 'heroicon-o-check-circle',
                        '1' => 'heroicon-o-archive-box-arrow-down',
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/index'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'view' => Pages\ViewProject::route('/{record}'),
        ];
    }
}
