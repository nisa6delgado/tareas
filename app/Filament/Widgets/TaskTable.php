<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

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
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tasks.title'))
                    ->url(fn ($record): string => '/' . $record->project->slug . '/tasks/' . $record->id)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('project.name')
                    ->label(__('tasks.project'))
                    ->url(fn ($record): string => '/' . $record->project->slug)
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label(__('tasks.edit'))
                    ->url(fn (Model $record) => $record->project->slug . '/tasks/' . $record->id . '/edit')
                    ->icon('heroicon-m-pencil-square'),

                Tables\Actions\Action::make('show')
                    ->label(__('tasks.show'))
                    ->url(fn (Model $record) => $record->project->slug . '/tasks/' . $record->id)
                    ->icon('heroicon-m-eye'),
                    
                Tables\Actions\DeleteAction::make()
            ]);
    }
}
