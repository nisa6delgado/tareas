<?php

namespace App\Filament\Pages;

use App\Models\Task;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class ViewTask extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-task';

    protected static ?string $slug = '{slug}/tasks/{task_id}';

    public $task;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    
    public function mount($task_id)
    {
        $this->task = Task::find($task_id);
    }

    public function getTitle(): string|Htmlable
    {
        return $this->task->title;
    }

    protected function getHeaderActions(): array
    {
        $actions[] = Actions\Action::make('edit')
            ->label(__('tasks.edit'))
            ->url('/' . $this->task->project->slug . '/tasks/' . $this->task->id . '/edit')
            ->icon('heroicon-o-pencil-square')
            ->keyBindings(['ctrl+e']);

        if ($this->task->status) {
            $actions[] = Actions\Action::make('pending')
                ->label(__('tasks.mark_as_pending'))
                ->action(function () {
                    $this->task->update(['status' => 0]);
                    
                    Notification::make()
                        ->success()
                        ->title(__('tasks.updated'))
                        ->send();

                    return redirect('/' . $this->task->project->slug . '/tasks/' . $this->task->id);
                })
                ->icon('heroicon-o-exclamation-circle');

        } else {
            $actions[] = Actions\Action::make('completed')
                ->label(__('tasks.mark_as_completed'))
                ->action(function () {
                    $this->task->update(['status' => 1]);
                    
                    Notification::make()
                        ->success()
                        ->title(__('tasks.updated'))
                        ->send();

                    return redirect('/' . $this->task->project->slug . '/tasks/' . $this->task->id);
                })
                ->icon('heroicon-o-check-circle')
                ->color('success');
        }

        $actions[] = Actions\DeleteAction::make('delete')
            ->requiresConfirmation()
            ->record($this->task)
            ->successRedirectUrl('/')
            ->successNotificationTitle(__('tasks.deleted'))
            ->icon('heroicon-o-trash')
            ->color('danger')
            ->keyBindings(['ctrl+d']);

        return $actions;
    }
}
