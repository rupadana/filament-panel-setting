<?php

namespace Rupadana\FilamentPanelSetting\Pages;

use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Rupadana\FilamentPanelSetting\FilamentPanelSetting;

class PanelSetting extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getSavedPanelSettingData());
    }

    public function getSavedPanelSettingData()
    {
        $data = app(FilamentPanelSetting::class)->getCurrentActivatedData(Filament::getCurrentPanel());

        return $data;
    }

    public function getPanelSettingStoreName()
    {
        $panel = Filament::getCurrentPanel();
        $panelId = $panel->getId();

        return "panel-$panelId-data.json";
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('brandName'),
                        Select::make('font')
                            ->options([
                                'Inter' => 'Inter',
                                'Poppins' => 'Poppins',
                                'Roboto' => 'Roboto',
                                'Montserrat' => 'Montserrat',
                                'Open Sans' => 'Open Sans',
                                'Lemon' => 'Lemon',
                                'Lato' => 'Lato',
                                'Salsa' => 'Salsa',
                                'Ubuntu' => 'Ubuntu',
                            ]),
                        FileUpload::make('brandLogo'),
                        FileUpload::make('favicon'),
                    ])

                // ...
            ])
            ->statePath('data');
    }

    public static function getNavigationGroup(): string
    {
        return __('filament-panel-setting::panel-setting.navigation.group');
    }

    public function create(): void
    {
        app(FilamentPanelSetting::class)->saveToDisk($this->form->getState());
        $this->redirect(route('filament.admin.pages.panel-setting'));
        Notification::make()
        ->title(__('filament-panel-setting::panel-setting.title.panel setting saved successfully'))
            ->success()
            ->send();
    }

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static string $view = 'filament-panel-setting::pages.panel-setting';


    public static function shouldRegisterNavigation(): bool
    {
        return config('panel-setting.page.setting');
    }
}
