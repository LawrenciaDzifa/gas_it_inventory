<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockHistoryResource\Pages;
use App\Filament\Resources\StockHistoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Item;
use App\Models\StockHistory;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockHistoryResource extends Resource
{
    protected static ?string $model = StockHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('item_name')->sortable()->searchable()->getStateUsing(function (Model $record) {
                    return Item::find($record->item_name)->name;
                }),
                TextColumn::make('category_name')->sortable()->searchable()->getStateUsing(function (Model $record) {
                    return Category::find($record->category_name)->name;
                }),
                TextColumn::make('quantity'),
                TextColumn::make('user')->getStateUsing(function (Model $record) {
                    return User::find($record->user)->name;
                }),
                BadgeColumn::make('type')
                    ->enum([
                        'initial stock' => 'Initial stock',
                        'restock' => 'Restock',
                    ])
                    ->colors([
                        'warning' => 'Restock',
                        'success' => 'Initial stock',
                    ])
                    ->sortable()->searchable(),


                TextColumn::make('created_at')
                    ->dateTime()->dateTime('d-M-Y'),
               
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockHistories::route('/'),
            'create' => Pages\CreateStockHistory::route('/create'),
            'edit' => Pages\EditStockHistory::route('/{record}/edit'),
        ];
    }
}
