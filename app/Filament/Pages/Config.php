<?php

namespace App\Filament\Pages;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Config extends Page implements HasForms
{
    protected static string $view = 'filament.pages.config';

    protected static ?string $slug = '/config';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function getTitle(): string|Htmlable
    {
        return __('dashboard.config');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label(__('config.name'))
                ->required()
                ->autofocus(),

            Forms\Components\TextInput::make('user')
                ->label(__('config.user'))
                ->required(),

            Forms\Components\TextInput::make('password')
                ->label(__('config.password'))
                ->password()
                ->required(),

            Forms\Components\TextInput::make('photo')
                ->label(__('config.photo'))
                ->required(),
            
            Forms\Components\TextInput::make('icon')
                ->label(__('config.icon'))
                ->required(),

            Forms\Components\TextInput::make('color')
                ->label(__('config.color'))
                ->required(),

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
                ->url('/')
                ->label(__('tasks.cancel'))
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
