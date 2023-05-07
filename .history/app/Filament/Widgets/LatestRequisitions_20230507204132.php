<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\Requisition;
use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestRequisitions extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    public static function getEloquentQuery(): Builder
{
    if (Auth::user()->role == 'admin') {
        return parent::getEloquentQuery();
    } else {
        return parent::getEloquentQuery()->where('user', Auth::user()->id);
    }
}

    protected function getTableQuery(): Builder
    {
        return Requisition::where('status', 'pending')->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user')
                ->searchable()
                ->getStateUsing(function (Requisition $record) {
                    return User::find($record->user)->name;
                }),

            Tables\Columns\TextColumn::make('item_name')
                ->getStateUsing(function (Requisition $record) {
                    return Item::find($record->item_name)->name;
                }),
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
