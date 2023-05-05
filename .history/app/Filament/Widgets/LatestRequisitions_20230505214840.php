<?php

namespace App\Filament\Widgets;

use App\Models\Requisition;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestRequisitions extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Requisition::query()->latest();

    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('item.name')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('qty_requested'),
            Tables\Columns\TextColumn::make('msg'),
            Tables\Columns\BadgeColumn::make('status'),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d-M-Y'),



                ];
    }
}
