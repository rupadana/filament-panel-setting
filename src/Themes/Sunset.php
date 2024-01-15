<?php

namespace Rupadana\FilamentPanelSetting\Themes;


use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Rupadana\FilamentPanelSetting\Themes\Contracts\Theme;

class Sunset extends Theme
{
    public function getName(): string
    {
        return "sunset";
    }

    public function register(Panel $panel): void {
       
    }

    public function getThemeDescription(): ?string
    {
        return "Theme by Hasnayeen";
    }

    public function getThumbnails(): ?array
    {
        return [
            'https://res.cloudinary.com/rupadana/image/upload/v1705144572/Screenshot_2024-01-13_at_19.15.50_tek5ie.png',
            'https://res.cloudinary.com/rupadana/image/upload/v1705144571/Screenshot_2024-01-13_at_19.15.59_qrg0au.png'
        ];
    }

    public function getAssets() : array {
        return [
            Css::make($this->getName(), __DIR__ . '/../../resources/dist/sunset.css')
        ];
    }
}
