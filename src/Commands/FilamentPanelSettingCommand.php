<?php

namespace Rupadana\FilamentPanelSetting\Commands;

use Illuminate\Console\Command;

class FilamentPanelSettingCommand extends Command
{
    public $signature = 'filament-panel-setting';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
