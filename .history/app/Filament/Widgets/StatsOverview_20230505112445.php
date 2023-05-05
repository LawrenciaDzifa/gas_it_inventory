<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make()
                ->primary()
                ->title('Total Users')
                ->value(100)
                ->trend('up')
                ->trendValue(5.5)
                ->trendPeriod('since last month'),
        ];
    }
}
