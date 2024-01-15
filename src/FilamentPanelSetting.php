<?php

namespace Rupadana\FilamentPanelSetting;

use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Rupadana\FilamentPanelSetting\Themes\Contracts\Theme;
use Rupadana\FilamentPanelSetting\Themes\Darkest;
use Rupadana\FilamentPanelSetting\Themes\DefaultTheme;
use Rupadana\FilamentPanelSetting\Themes\Dracula;
use Rupadana\FilamentPanelSetting\Themes\Nord;
use Rupadana\FilamentPanelSetting\Themes\Sky;
use Rupadana\FilamentPanelSetting\Themes\Sunset;

class FilamentPanelSetting
{
    protected Collection | null $themes = null;

    protected $enableThemeName = 'default';

    protected string $disk = 'local';



    public function __construct()
    {

        $this->themes = collect([
            DefaultTheme::make()->getName() => DefaultTheme::class,
            Darkest::make()->getName() => Darkest::class,
            Sky::make()->getName() => Sky::class,
            Nord::make()->getName() => Nord::class,
            Sunset::make()->getName() => Sunset::class
        ]);
    }

    public function test() {

        return Filament::getCurrentPanel();
    }

    public static function make(): static
    {
        return new static();
    }

    public function getEnabledTheme(): Theme
    {
        // dd(app(static::class)->getThemes()->toArray()[$this->enableThemeName]);
        if (isset(app(static::class)->getThemes()->toArray()[$this->enableThemeName])) {
            return app(app(static::class)->getThemes()->toArray()[$this->enableThemeName]);
        }


        return app(app(static::class)->getThemes()->first());
    }

    public function enableTheme(string $theme = Theme::Default)
    {
        $this->enableThemeName = $theme;

        return $this;
    }

    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function getTheme(string $theme)
    {
        return app(app(static::class)->getThemes()->toArray()[$theme]);
    }

    public function themes(array $themes): FilamentPanelSetting
    {
        $this->themes = $this->themes->merge($themes);
        return $this;
    }

    public function disk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function getDisk()
    {
        return $this->disk;
    }

    public function getStorageDisk()
    {
        return Storage::disk($this->getDisk());
    }

    public function getCurrentActivatedData(Panel $panel)
    {
        return json_decode($this->getStorageDisk()->get('panel-' . $panel->getId() . '-data.json'), true) ?? [];
    }

    public function saveThemeToDisk(string $theme)
    {
        return $this->getStorageDisk()->put('panel-' . Filament::getCurrentPanel()->getId() . '-data.json', json_encode([
            ...$this->getCurrentActivatedData(Filament::getCurrentPanel()),
            'theme' => $theme
        ]));
    }

    public function saveToDisk(array $datas) {
        $this->getStorageDisk()->put('panel-' . Filament::getCurrentPanel()->getId() . '-data.json', json_encode([
            ...$this->getCurrentActivatedData(Filament::getCurrentPanel()),
            ...$datas
        ]));
    }
}
