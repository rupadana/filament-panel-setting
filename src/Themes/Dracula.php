<?php

namespace Rupadana\FilamentPanelSetting\Themes;


use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Rupadana\FilamentPanelSetting\Themes\Contracts\Theme;

class Dracula extends Theme
{
    public function getName(): string
    {
        return "dracula";
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
            'https://res.cloudinary.com/rupadana/image/upload/v1705144472/Screenshot_2024-01-13_at_19.14.03_zroujt.png',
            'https://res.cloudinary.com/rupadana/image/upload/v1705144471/Screenshot_2024-01-13_at_19.14.17_ilsnhd.png'
        ];
    }

    public function getAssets() : array {
        return [
            Css::make($this->getName(), __DIR__ . '/../../resources/dist/dracula.css')
        ];
    }
}
