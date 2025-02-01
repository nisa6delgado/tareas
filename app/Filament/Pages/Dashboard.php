<?php
 
namespace App\Filament\Pages;

use Filament\Actions;
 
class Dashboard extends \Filament\Pages\Dashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('dashboard.create_project'))
                ->url('/projects/create')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}