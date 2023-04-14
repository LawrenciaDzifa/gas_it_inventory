<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockHistoryResource\Pages;
use App\Filament\Resources\StockHistoryResource\RelationManagers;
use App\Models\StockHistory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockHistoryResource extends Resource
{
    protected static ?string $model = StockHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
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
                TextColumn::make('item_name'),
                TextColumn::make('category_name'),
                TextColumn::make('quantity'),
                TextColumn::make('type'),
                TextColumn::make('created_at')
                    ->dateTime()->dateTime('d-M-Y'),
                TextColumn::make('deleted_at')
                    ->dateTime()->dateTime('d-M-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Delete
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
