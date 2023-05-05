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
            ->chart([
                'labels' => Item::all()->pluck('name'),
                'datasets' => [
                    [
                        'label' => 'Total Items',
                        'backgroundColor' => '#4c51bf',
                        'data' => Item::all()->pluck('qty'),
                    ],
                ],
            ]),
            Card::make('Total Requisitions', Requisition::count()),
            Card::make('Total Assignments', Assignment::count()),

        ];
    }
}
