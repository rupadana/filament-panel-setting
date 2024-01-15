<?php

namespace Rupadana\FilamentPanelSetting\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rupadana\FilamentPanelSetting\FilamentPanelSetting
 */
class FilamentPanelSetting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Rupadana\FilamentPanelSetting\FilamentPanelSetting::class;
    }
}
