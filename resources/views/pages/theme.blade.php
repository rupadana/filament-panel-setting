<?php
    $filatheme = app(\Rupadana\FilamentPanelSetting\FilamentPanelSetting::class);
    $themes = $filatheme->getThemes();
    $enabledTheme = $filatheme->getEnabledTheme()->getName();

?>

<x-filament-panels::page>
    @foreach($themes as $theme)
        <?php
            /**
             * @var \Rupadana\FilamentPanelSetting\Themes\Contracts\Theme $theme
             */
            $theme = app($theme);
            $isEnabled = $theme->getName() == $enabledTheme;
        ?>



        <x-filament::section>
            <x-slot name="heading">
                {{ucfirst($theme->getName())}}
            </x-slot>

            <x-slot name="headerEnd">
                <x-filament::button
                    wire:click="enableTheme('{{$theme->getName()}}')"
                    color="{{$isEnabled ? 'gray' : 'primary'}}"
                    class="cursor-pointer"
                >
                    {{$isEnabled ? __('filament-panel-setting::themes.activated') : __('filament-panel-setting::themes.enable')}}

                </x-filament::button>
            </x-slot>

            <x-slot name="description">
                {{$theme->getThemeDescription()}}
            </x-slot>


            <swiper-container
                pagination="true"
                navigation="true"
            >
                @foreach($theme->getThumbnails() ?? [] as $thumbnail)
                    <swiper-slide class="rounded-3xl">
                        <img src="{{$thumbnail}}">
                    </swiper-slide>
                @endforeach

            </swiper-container>

        </x-filament::section>
    @endforeach


    <x-filament-actions::modals />

</x-filament-panels::page>
