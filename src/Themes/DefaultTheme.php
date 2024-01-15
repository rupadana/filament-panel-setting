<?php

namespace Rupadana\FilamentPanelSetting\Themes;


use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Rupadana\FilamentPanelSetting\Themes\Contracts\Theme;

class DefaultTheme extends Theme 
{
    public function getName(): string
    {
        return 'default';
    }

    public function register(Panel $panel): void
    {
        
    }

    public function getThumbnails(): ?array
    {
        return [
            'https://res.cloudinary.com/rupadana/image/upload/v1705143257/Screenshot_2024-01-13_at_18.53.19_ydvydk.png',
            'https://res.cloudinary.com/rupadana/image/upload/v1705143257/Screenshot_2024-01-13_at_18.52.51_uy1bru.png'
        ];
    }

    public function getThemeDescription(): ?string
    {
        return 'Theme by Filament';
    }

    public function getAssets(): array
    {
        return [];
    }
}