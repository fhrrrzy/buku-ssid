<?php

namespace App\Providers\Filament;

use Filament\Pages;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Platform;
use App\Filament\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Rmsramos\Activitylog\ActivitylogPlugin;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use Guava\FilamentKnowledgeBase\KnowledgeBasePlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Cmsmaxinc\FilamentErrorPages\FilamentErrorPagesPlugin;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                StatsOverview::class
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            // ->topNavigation()
            ->databaseNotifications()
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
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->globalSearchDebounce('750ms')
            ->globalSearchFieldSuffix(fn(): ?string => match (Platform::detect()) {
                Platform::Windows, Platform::Linux => 'CTRL+K',
                Platform::Mac => '⌘K',
                default => null,
            })
            ->plugins([
                FilamentShieldPlugin::make(),
                \Filafly\PhosphorIconReplacement::make()->duotone(),
                ActivitylogPlugin::make()
                    ->label('Log')
                    ->pluralLabel('Logs')
                    ->navigationSort(4),
                BreezyCore::make()
                    ->myProfile(
                        userMenuLabel: 'My Profile', // Customizes the 'account' link label in the panel User Menu (default = null)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    )->enableTwoFactorAuthentication(
                        force: true, // force the user to enable 2FA before they can use the application (default = false)
                    ),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                \Hasnayeen\Themes\ThemesPlugin::make(),
                GlobalSearchModalPlugin::make()
                    ->slideOver(),
                FilamentErrorPagesPlugin::make(),
                KnowledgeBasePlugin::make(),
                AuthUIEnhancerPlugin::make()
                    ->mobileFormPanelPosition('top')
                    ->formPanelPosition('left')
                    ->formPanelWidth('40%')
                    ->emptyPanelBackgroundImageOpacity('70%')
                    ->emptyPanelBackgroundImageUrl(asset('images/login.jpeg')),

            ])
            ->authMiddleware([
                Authenticate::class,

            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->spa();
    }
}
