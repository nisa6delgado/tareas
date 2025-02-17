<?php

namespace App\Filament\Pages;

use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Form;
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

        $data = $this->task->toArray();
        
        foreach ($this->task->files as $file) {
            $data['uploaded_files'][] = $file->name;
        }

        $this->form->fill($data);
    }

    public function getTitle(): string|Htmlable
    {
        return __('tasks.edit_task');
    }

    public function form(Form $form): Form
    {
        $projects = Project::pluck('name', 'id');

        $uploaded = [];

        foreach ($this->task->files as $file) {
            $uploaded[$file->name] = $file->name;
        }

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
                ->label(__('tasks.description'))
                ->rows(8),

            Forms\Components\CheckboxList::make('uploaded_files')
                ->label(__('tasks.uploaded_files'))
                ->options($uploaded)
                ->visible(empty($uploaded) ? false : true)
                ->columns(3),

            Forms\Components\FileUpload::make('files_to_upload')
                ->label(__('tasks.files_to_upload'))
                ->multiple()

        ])->statePath('data');
    }

    public function getFormActions()
    {
        return [
            Forms\Components\Actions\Action::make('submit')
                ->submit('submit')
                ->label(__('tasks.save'))
                ->icon('heroicon-o-check-circle')
                ->keyBindings(['ctrl+s']),

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

        $this->task->update($data->except(['uploaded_files', 'files_to_upload'])->toArray());

        File::where('task_id', $this->task->id)->delete();

        if (isset($data->all()['uploaded_files'])) {
            foreach ($data->all()['uploaded_files'] as $uploaded) {
                File::create([
                    'task_id' => $this->task->id,
                    'name' => $uploaded,
                ]);
            }
        }

        foreach ($data->all()['files_to_upload'] as $upload) {
            File::create([
                'task_id' => $this->task->id,
                'name' => $upload,
            ]);
        }
        
        return redirect('/' . $this->task->project->slug . '/tasks/' . $this->task->id);
    }
}
