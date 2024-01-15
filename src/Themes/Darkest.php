<?php

namespace Rupadana\FilamentPanelSetting\Themes;


use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Rupadana\FilamentPanelSetting\Themes\Contracts\Theme;

class Darkest extends Theme
{
    public function getName(): string
    {
        return "darkest";
    }

    public function register(Panel $panel): void
    {
        $panel->colors([
            'primary' => Color::Orange
        ]);
    }

    public function getThemeDescription(): ?string
    {
        return "Theme by Rupadana";
    }

    public function getThumbnails(): ?array
    {
        return [
            'https://res.cloudinary.com/rupadana/image/upload/v1705144717/Screenshot_2024-01-13_at_19.18.11_llse31.png',
            'https://res.cloudinary.com/rupadana/image/upload/v1705144716/Screenshot_2024-01-13_at_19.18.22_sc0d1m.png'
        ];
    }

    public function getAssets(): array
    {
        return [
            Css::make($this->getName(), __DIR__ . '/../../resources/dist/darkest.css')
        ];
    }
}
