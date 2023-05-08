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


    protected function getTableQuery(): Builder
    {
        if (Auth::user()->role == 'admin') {
            return Requisition::query()->where('status','pending');
        } else {
            return Requisition::query()->where('user', Auth::user()->id);
        }
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
            Tables\Columns\TextColumn::make('created_at')
            ->dateTime('d-M-Y'),
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

        ];
    }
    public static function get
}
