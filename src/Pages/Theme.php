<?php

namespace Rupadana\FilamentPanelSetting\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Rupadana\FilamentPanelSetting\FilamentPanelSetting;

class Theme extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-panel-setting::pages.theme';

    protected FilamentPanelSetting $filamentPanelSetting;

    public static function getNavigationGroup(): string
    {
        return __('filament-panel-setting::panel-setting.navigation.group');
    }

    public function enableTheme(string $theme = \Rupadana\FilamentPanelSetting\Themes\Contracts\Theme::Ocean)
    {
        if ($this->filamentPanelSetting->getEnabledTheme()->getName() == $theme) {

            Notification::make()
                ->title(__('filament-panel-setting::themes.title.theme already enabled'))
                ->info()
                ->send();

            return;
        }

        $this->filamentPanelSetting->saveThemeToDisk($theme);

        Notification::make()
            ->title(__('filament-panel-setting::themes.title.theme successfully enabled'))
            ->success()
            ->send();

        return $this->redirect(route('filament.admin.pages.theme'));
    }

    public function boot()
    {
        $this->filamentPanelSetting = app(FilamentPanelSetting::class);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return config('panel-setting.page.theme') && auth()->user()->hasRole(config('panel-setting.can_access.role') ?? []);
    }
}
