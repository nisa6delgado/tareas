<?php

namespace App\Providers\Filament;

use App\Filament\Pages;
use App\Filament\Widgets\TaskDateChart;
use App\Filament\Widgets\TaskProjectChart;
use App\Filament\Widgets\TaskStatusChart;
use App\Filament\Widgets\TaskTable;
use App\Models\Config;
use App\Models\Project;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
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

        $color = Config::where('key', 'color')->first();
        $color = $color ? $color->value : '#000000';

        $logo = Config::where('key', 'icon')->first();
        $logo = $logo ? $logo->value : '';

        return $panel
            ->default()
            ->id('admin')
            ->favicon($logo)
            ->brandLogo(function () use ($logo) {
                return view('filament.admin.logo', compact('logo'));
            })
            ->path('/')
            ->login()
            ->colors([
                'primary' => Color::hex($color),
            ])
            ->navigationItems($navigationItems)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->userMenuItems([
                MenuItem::make()
                    ->label(__('dashboard.config'))
                    ->url(fn (): string => Pages\Config::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                TaskProjectChart::class,
                TaskStatusChart::class,
                TaskDateChart::class,
                TaskTable::class
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
            ->assets([
                Css::make('app', resource_path('css/app.css')),
            ])
            ->sidebarCollapsibleOnDesktop();
    }
}
