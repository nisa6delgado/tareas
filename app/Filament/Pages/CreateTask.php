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

class CreateTask extends Page implements HasForms
{
    protected static string $view = 'filament.pages.create-task';

    protected static ?string $slug = '/tasks/{slug}/create';

    public $project;

    public ?array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount($slug)
    {
        $this->project = Project::where('slug', $slug)->first();
        $this->form->fill();
    }

    public function getTitle(): string|Htmlable
    {
        return __('tasks.create_task');
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
                ->default($this->project->id)
                ->selectablePlaceholder(false)
                ->required(),

            Forms\Components\Select::make('format')
                ->label(__('tasks.format'))
                ->options(formts())
                ->default('markdown')
                ->selectablePlaceholder(false)
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

        $task = Task::create($data->except('files')->toArray());

        foreach ($data->all()['files'] as $file) {
            File::create([
                'task_id' => $task->id,
                'name' => $file,
            ]);
        }

        return redirect('/' . $task->project->slug . '/tasks/' . $task->id);
    }
}
