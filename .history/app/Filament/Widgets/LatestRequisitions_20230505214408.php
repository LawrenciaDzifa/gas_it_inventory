<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestRequisitions extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Requisition::query()->latest();
        // ...

    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->sortable()
                ->searchable(),
            Tables\Columns\Text::make('item.name')
                ->sortable()
                ->searchable(),
            Tables\Columns\Text::make('qty_requested'),
            Tables\Columns\Text::make('msg'),
            Tables\Columns\Text::make('status'),
            Tables\Columns\Text::make('created_at')
                ->dateTime('d-M-Y'),



                ];
    }
}
