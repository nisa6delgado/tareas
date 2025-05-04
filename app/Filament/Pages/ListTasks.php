<?php

namespace App\Filament\Pages;

use App\Models\Project;
use App\Models\Task;
use Filament\Actions;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class ListTasks extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.pages.list-tasks';

    protected static ?string $slug = '/{slug}';

    public $project;
    
    public function mount($slug)
    {
        $this->project = Project::where('slug', $slug)->first();
    }
    
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view-all-tasks')
                ->label(__('tasks.view_all_tasks'))
                ->url('?all=1')
                ->icon('heroicon-o-list-bullet')
                ->visible(! request()->all ?? false)
                ->keyBindings(['ctrl+a']),

            Actions\Action::make('view-pending-tasks')
                ->label(__('tasks.view_pending_tasks'))
                ->url('?')
                ->icon('heroicon-o-list-bullet')
                ->visible(request()->all ?? false)
                ->keyBindings(['ctrl+a']),

            Actions\Action::make('create')
                ->label(__('tasks.create_task'))
                ->url('/tasks/' . $this->project->slug . '/create')
                ->icon('heroicon-o-plus-circle')
                ->keyBindings(['ctrl+m']),

            Actions\Action::make('edit')
                ->label(__('tasks.edit_this_project'))
                ->url('/projects/' . $this->project->id . '/edit')
                ->icon('heroicon-o-pencil-square')
                ->keyBindings(['ctrl+e']),

            Actions\DeleteAction::make('delete')
                ->requiresConfirmation()
                ->record($this->project)
                ->successRedirectUrl('/')
                ->successNotificationTitle(__('tasks.deleted'))
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->keyBindings(['ctrl+d']),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return $this->project->name;
    }

    public function table(Table $table): Table
    {
        $tasks = Task::where('project_id', $this->project->id)->where('status', 0)->orderByDesc('updated_at');

        if (request()->all) {
            $tasks = Task::where('project_id', $this->project->id)->orderByDesc('updated_at');
        }

        return $table
            ->query($tasks)
            ->columns([
                Tables\Columns\TextColumn::make('#')->state(
                    static function (HasTable $livewire, stdClass $rowLoop) use ($tasks) {
                        $recordsPerPage = $livewire->getTableRecordsPerPage() == 'all' ? $tasks->count() : $livewire->getTableRecordsPerPage();
                        
                        return (string) (
                            $rowLoop->iteration + ($recordsPerPage * ($livewire->getTablePage() - 1))
                        );
                    }
                ),
                
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tasks.title'))
                    ->url(fn ($record): string => '/' . $record->project->slug . '/tasks/' . $record->id)
                    ->searchable(),

                Tables\Columns\TextColumn::make('status_name')
                    ->label(__('tasks.status'))
                    ->badge()
                    ->icon(fn (string $state): string => match ($state) {
                        __('tasks.pending') => 'heroicon-o-exclamation-circle',
                        __('tasks.completed') => 'heroicon-o-check-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        __('tasks.pending') => 'warning',
                        __('tasks.completed') => 'success',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label(__('tasks.edit'))
                    ->url(fn (Model $record) => $this->project->slug . '/tasks/' . $record->id . '/edit')
                    ->icon('heroicon-m-pencil-square')
                    ->extraAttributes(['class' => 'hidden md:flex']),

                Tables\Actions\Action::make('show')
                    ->label(__('tasks.show'))
                    ->url(fn (Model $record) => $this->project->slug . '/tasks/' . $record->id)
                    ->icon('heroicon-m-eye')
                    ->extraAttributes(['class' => 'hidden md:flex']),
                    
                Tables\Actions\DeleteAction::make()->extraAttributes(['class' => 'hidden md:flex'])
            ])
            ->paginated(request()->all ? false : true);
    }
}
