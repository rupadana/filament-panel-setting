<?php

namespace Rupadana\FilamentPanelSetting;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Rupadana\FilamentPanelSetting\Commands\FilamentPanelSettingCommand;
use Rupadana\FilamentPanelSetting\Testing\TestsFilamentPanelSetting;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPanelSettingServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-panel-setting';

    public static string $viewNamespace = 'filament-panel-setting';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasViews()
            ->hasConfigFile('panel-setting')
            ->hasTranslations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('rupadana/filament-panel-setting');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(FilamentPanelSetting::class, function () {
            return new FilamentPanelSetting();
        });
    }

    public function packageBooted(): void
    {

        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-panel-setting/{$file->getFilename()}"),
                ], 'filament-panel-setting-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentPanelSetting());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'rupadana/filament-panel-setting';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {

        if (app()->runningInConsole()) {

            return app(FilamentPanelSetting::class)
                ->getThemes()
                ->reduce(
                    function ($assets, $theme) {
                        $asset = app($theme)
                            ->getAssets();

                        if (empty($assets)) {
                            return $asset;
                        }

                        return [
                            ...$assets,
                            ...$asset,
                        ];
                    },
                );
        }

        /**
         * @var Theme $enabledTheme
         */
        $enabledTheme = app(FilamentPanelSetting::class)->getEnabledTheme();

        return $enabledTheme->getAssets();
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentPanelSettingCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_filament-panel-setting_table',
        ];
    }
}
