<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('total_users', 'Total Users', 'heroicon-o-user-group')
               
            Card::make('total_users', 'Total Users', 'heroicon-o-user-group')
                ->title('Total Users')
                ->value(100)
                ->trend('up')
                ->trendValue(5.5)
                ->trendPeriod('since last month'),
            Card::make('total_users', 'Total Users', 'heroicon-o-user-group')
                ->title('Total Users')
                ->value(100)
                ->trend('up')
                ->trendValue(5.5)
                ->trendPeriod('since last month'),
        ];
    }
}
