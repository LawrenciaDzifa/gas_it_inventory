<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestockResource\Pages;
use App\Filament\Resources\RestockResource\RelationManagers;
use App\Models\Restock;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestockResource extends Resource
{
    protected static ?string $model = Restock::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Inventory Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('item_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('restock_qty')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_name')->sortable()->searchable(),
                TextColumn::make('restock_qty'),
                TextColumn::make('created_at')->dateTime('d-M-Y'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime('d-M-Y'),
                Tables\Columns\TextColumn::make('deleted_at')->dateTime('d-M-Y')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRestocks::route('/'),
            'create' => Pages\CreateRestock::route('/create'),
            'edit' => Pages\EditRestock::route('/{record}/edit'),
        ];
    }
}
