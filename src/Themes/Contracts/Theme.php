<?php
namespace Rupadana\FilamentPanelSetting\Themes\Contracts;

use Filament\Panel;

abstract class Theme {

    const Ocean = 'ocean';
    const Sky = 'sky';
    const Default = 'default';

    abstract public function getName(): string;

    public static function make() : static {
        return new static();
    }

    abstract public function register(Panel $panel): void;
    abstract public function getAssets() : array;

    public function getThumbnails(): ?array {
        return null;
    }
    public function getThemeColor() : array {
        return [];
    }

    public function getThemeDescription(): ?string
    {
        return null;
    }
}
