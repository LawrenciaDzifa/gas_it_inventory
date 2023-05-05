<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\Requisition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Items', Item::count())
                ,
            Card::make('Total Requisitions', Requisition::count())
                ,
            Card::make('Total Assig', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-s-trending-up'),

        ];
    }
}
