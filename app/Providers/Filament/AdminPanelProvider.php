<?php

namespace App\Providers\Filament;

use App\Filament\Pages;
use App\Filament\Widgets\TaskDateChart;
use App\Filament\Widgets\TaskProjectChart;
use App\Filament\Widgets\TaskStatusChart;
use App\Models\Project;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $projects = Project::orderBy('name')->get();

        $navigationItems = [];

        foreach ($projects as $project) {
            $navigationItems[] = NavigationItem::make()
                ->label($project->name)
                ->icon('heroicon-o-' . $project->icon)
                ->url('/' . $project->slug)
                ->isActiveWhen(fn () => strpos(request()->getPathInfo(), $project->slug));
        }

        return $panel
            ->default()
            ->id('admin')
            ->path('/')
            ->login()
            ->colors([
                'primary' => Color::hex('#000'),
            ])
            ->navigationItems($navigationItems)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                TaskProjectChart::class,
                TaskStatusChart::class,
                TaskDateChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop();
    }
}
