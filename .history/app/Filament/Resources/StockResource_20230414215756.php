<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Stock;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Inventory Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('item_name')
                    ->required()
                    ->maxLength(255),
                // TextInput::make('category_name')
                //     ->required()
                //     ->maxLength(255),
                    // Select::make('categories', 'category_name')->relationship('categories', 'category_name')->preload()->multiple()->required(),
                    // Select::make('categories')->relationship('categories', 'category_name')->preload()->multiple()->required(),

                    // aselect fileld for category
                    
                TextInput::make('quantity')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('item_name')->sortable()->searchable(),
                TextColumn::make('category_name')->sortable()->searchable(),
                TextColumn::make('quantity'),
                TextColumn::make('created_at')
                    ->dateTime()->dateTime('d-M-Y'),
                TextColumn::make('deleted_at')
                    ->dateTime()->dateTime('d-M-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
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
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }
}
