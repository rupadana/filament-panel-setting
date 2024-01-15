<?php

namespace Rupadana\FilamentPanelSetting;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;
use Rupadana\FilamentPanelSetting\Themes\Contracts\Theme;

class FilamentPanelSettingPlugin implements Plugin
{
    protected FilamentPanelSetting $filamentPanelSetting;

    public function __construct()
    {
        $this->filamentPanelSetting = app(FilamentPanelSetting::class);
    }

    public function getId(): string
    {
        return 'filament-panel-setting';
    }

    public function register(Panel $panel): void
    {
        $datas = app(FilamentPanelSetting::class)->getCurrentActivatedData($panel);
        
        $panel->pages([
            \Rupadana\FilamentPanelSetting\Pages\Theme::class,
            \Rupadana\FilamentPanelSetting\Pages\PanelSetting::class,
        ]);

        $imagesKey = [
            'brandLogo',
            'favicon'
        ];

        $excluded = [
            'theme'
        ];


        foreach ($datas as $key => $value) {
            if ($value) {
                if (!in_array($key, $excluded)) {
                    if (in_array($key, $imagesKey)) {
                        $panel->$key(config('app.url') . '/storage/' . $value);
                    } else {
                        $panel->$key($value);
                    }
                }
            }
        }

        if (isset($datas['theme'])) {
            app(FilamentPanelSetting::class)->enableTheme($datas['theme']);
        }

        app(FilamentPanelSetting::class)->getEnabledTheme()->register($panel);
    }

    public function enableTheme(string $theme = Theme::Default)
    {
        app(FilamentPanelSetting::class)->enableTheme($theme);
        return $this;
    }

    public function registerThemes(array $themes = [])
    {
        app(FilamentPanelSetting::class)->themes($themes);
        return $this;
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
