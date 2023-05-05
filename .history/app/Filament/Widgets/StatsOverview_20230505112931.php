<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Items', Item::count())
                ,
            Card::make('Total Requisitions', Requisi)
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-down'),
            Card::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-s-trending-up'),

        ];
    }
}
