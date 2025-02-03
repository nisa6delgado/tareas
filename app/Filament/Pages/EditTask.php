<?php

namespace App\Filament\Pages;

use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class EditTask extends Page implements HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-task';

    protected static ?string $slug = '{slug}/tasks/{task_id}/edit';

    public $project;
    public $task;

    public ?array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount($slug, $task_id)
    {
        $this->project = Project::where('slug', $slug)->first();
        $this->task = Task::find($task_id);
        $this->form->fill($this->task->toArray());
    }

    public function getTitle(): string|Htmlable
    {
        return __('tasks.edit_task');
    }

    public function form(Form $form): Form
    {
        $projects = Project::pluck('name', 'id');

        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label(__('tasks.title'))
                ->required()
                ->autofocus(),

            Forms\Components\Select::make('project_id')
                ->label(__('tasks.project'))
                ->options($projects)
                ->required(),

            Forms\Components\Select::make('format')
                ->label(__('tasks.format'))
                ->options(formts())
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label(__('tasks.description')),

            Forms\Components\FileUpload::make('files')
                ->label(__('tasks.files'))
                ->multiple()

        ])->statePath('data');
    }

    public function getFormActions()
    {
        return [
            Forms\Components\Actions\Action::make('submit')
                ->submit('submit')
                ->label(__('tasks.save'))
                ->icon('heroicon-o-check-circle'),

            Forms\Components\Actions\Action::make('cancel')
                ->url('/' . $this->project->slug)
                ->label(__('tasks.cancel'))
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }

    public function submit()
    {
        $data = collect($this->form->getState());

        $task = $this->task->update($data->except('files')->toArray());

        foreach ($data['files'] as $file) {
            File::create([
                'task_id' => $task->id,
                'name' => $file,
            ]);
        }

        return Notification::make()
            ->success()
            ->title(__('tasks.updated'))
            ->send();
    }
}
