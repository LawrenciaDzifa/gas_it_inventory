<?php

namespace App\Filament\Widgets;

use App\Models\Assignment;
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
                ->icon('heroicon-o-cube'),

            Card::make('Total Requisitions', auth()->user()->role == 'admin' ? Requisition::count() : Requisition::where('user', auth()->user()->id)->count())
                ->icon('heroicon-o-gift'),
            Card::make('Total Assignments', auth)
                ->icon('heroicon-o-table'),

        ];
    }
}
