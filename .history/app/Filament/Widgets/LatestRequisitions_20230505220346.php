<?php

namespace App\Filament\Widgets;

use App\Models\Requisition;
use App\Models\User;
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
            Tables\Columns\TextColumn::make('user')
            //get user name from record
                ->searchable()
                ->sortable()
                ->getStateUsing(function (Requisition $record) {
                    return User::find($record->user)->name;
                }),

            Tables\Columns\TextColumn::make('item_name')
                ->searchable()
                ->sortable()
                ->getStateUsing(function (Requisition $record) {
                    return User::find($record->user)->name;
                }),,
            Tables\Columns\TextColumn::make('qty_requested'),
            Tables\Columns\TextColumn::make('msg'),
            Tables\Columns\BadgeColumn::make('status')->enum([
                'pending' => 'Pending',
                'approved' => 'Approved',
                'declined' => 'Declined',
            ])
                ->colors([
                    'warning' => 'pending',
                    'success' => 'approved',
                    'danger' => 'declined',
                ]),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d-M-Y'),



        ];
    }
}
