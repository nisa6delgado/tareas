<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class TaskTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('dashboard.tasks'))
            ->query(
                Task::query()->where('status', 0)->orderByDesc('updated_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('#')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration + ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1))
                        );
                    }
                ),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('tasks.title'))
                    ->url(fn ($record): string => '/' . $record->project->slug . '/tasks/' . $record->id)
                    ->searchable(),

                Tables\Columns\TextColumn::make('project.name')
                    ->label(__('tasks.project'))
                    ->url(fn ($record): string => '/' . $record->project->slug)
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label(__('tasks.edit'))
                    ->url(fn (Model $record) => $record->project->slug . '/tasks/' . $record->id . '/edit')
                    ->icon('heroicon-m-pencil-square')
                    ->extraAttributes(['class' => 'hidden md:flex']),

                Tables\Actions\Action::make('show')
                    ->label(__('tasks.show'))
                    ->url(fn (Model $record) => $record->project->slug . '/tasks/' . $record->id)
                    ->icon('heroicon-m-eye')
                    ->extraAttributes(['class' => 'hidden md:flex']),
                    
                Tables\Actions\DeleteAction::make()->extraAttributes(['class' => 'hidden md:flex'])
            ]);
    }
}
