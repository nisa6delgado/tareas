<?php

namespace App\Providers\Filament;

use App\Filament\Pages;
use App\Filament\Resources\ActivityResource;
use App\Filament\Widgets\TaskDateChart;
use App\Filament\Widgets\TaskProjectChart;
use App\Filament\Widgets\TaskStatusChart;
use App\Filament\Widgets\TaskTable;
use App\Models\Config;
use App\Models\Project;
use DB;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Rmsramos\Activitylog\ActivitylogPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $projects = [];
        $navigationItems = [];

        $defaultColor = '#000000';
        $defaultLogo = '';

        $projectTableExists = DB::select("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'projects'");
        $configTableExists = DB::select("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'configs'");

        if ($projectTableExists) {
            $projects = Project::orderBy('name')->get();

            foreach ($projects as $project) {
                $navigationItems[] = NavigationItem::make()
                    ->label($project->name)
                    ->icon('heroicon-o-' . $project->icon)
                    ->url('/' . $project->slug)
                    ->isActiveWhen(fn () => strpos(request()->getPathInfo(), $project->slug))
                    ->group(__('dashboard.projects'));
            }
        }

        if ($configTableExists) {
            $color = Config::where('key', 'color')->first();
            $color = isset($color->value) ? $color->value : $defaultColor;

            $logo = Config::where('key', 'icon')->first();
            $logo = isset($logo->value) ? $logo->value : $defaultLogo;
        } else {
            $logo = $defaultLogo;
            $color = $defaultColor;
        }

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
                    ->label(__('dashboard.activity'))
                    ->url('/activity/log')
                    ->icon('heroicon-o-list-bullet'),

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
                Js::make('app', resource_path('js/app.js')),
            ])
            ->plugins([
                ActivitylogPlugin::make()
                    ->resource(ActivityResource::class)
                    ->navigationItem(false),
            ])
            ->sidebarCollapsibleOnDesktop();
    }
}
