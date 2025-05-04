<?php

namespace App\Filament\Pages;

use App\Models\Config as Model;
use App\Models\User;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Config extends Page implements HasForms
{
    protected static string $view = 'filament.pages.config';

    protected static ?string $slug = '/config';

    public ?array $data = [];

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getTitle(): string|Htmlable
    {
        return __('dashboard.config');
    }

    public function mount()
    {
        $user = User::first();
        $config = Model::get();

        $data['name'] = $user->name;
        $data['email'] = $user->email;

        foreach ($config as $item) {
            $data[$item->key] = $item->value;
        }

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label(__('config.name'))
                ->required()
                ->autofocus(),

            Forms\Components\TextInput::make('email')
                ->label(__('config.email'))
                ->email()
                ->required(),

            Forms\Components\TextInput::make('password')
                ->label(__('config.password'))
                ->password(),

            Forms\Components\TextInput::make('photo')
                ->label(__('config.photo')),
            
            Forms\Components\TextInput::make('icon')
                ->label(__('config.icon')),

            Forms\Components\TextInput::make('color')
                ->label(__('config.color')),

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
                ->url('/')
                ->label(__('tasks.cancel'))
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }

    public function submit()
    {
        $data = collect($this->form->getState());
        
        $user = User::first();
        $user->update($data->only('name', 'email')->toArray());

        if ($data->all()['password']) {
            $user->update(['password' => $data->all()['password']]);
        }

        foreach ($data->only('photo', 'icon', 'color') as $key => $value) {
            Model::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
        
        return Notification::make()
            ->success()
            ->title(__('tasks.updated'))
            ->send();
    }
}
