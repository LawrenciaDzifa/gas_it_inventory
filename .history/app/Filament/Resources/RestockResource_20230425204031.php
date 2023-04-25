<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestockResource\Pages;
use App\Filament\Resources\RestockResource\RelationManagers;
use App\Models\Item;
use App\Models\Restock;
use App\Models\Stock;
use App\Models\StockHistory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestockResource extends Resource
{
    protected static ?string $model = Restock::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments';
    protected static ?string $navigationGroup = 'Inventory Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_name')
                    ->options(
                        Item::all()->pluck('name', 'id')
                    )
                    ->required(),
                Forms\Components\TextInput::make('restock_qty')
                    ->required()->integer(),
            ]);
    }
    public static function createRecord(CreateRecordRequest $request)
    {
        $record = static::fill(new static::$model(), $request->getInput());

        $record->save();

        //update stock
        $stock = Stock::where('item_name', $record->item_name)->first();
        $stock->quantity = $stock->quantity + $record->restock_qty;

      //record in stock history
      $stockHistory = new StockHistory();
      $stockHistory->item_name = $record->item_name;
      $stockHistory->quantity = $record->restock_qty;
      $stockHistory->user = Auth::user()->id;;
      $stockHistory->category_name = $stock->category_name;
      $stockHistory->type = 'restock';
      $stockHistory->save();

        return static::redirect('index', $record);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('item_name')->sortable()->searchable()->getStateUsing(function (Model $record) {
                    return Item::find($record->item_name)->name;
                }),
                TextColumn::make('restock_qty'),
                TextColumn::make('created_at')->dateTime('d-M-Y'),
                TextColumn::make('updated_at')->dateTime('d-M-Y'),
                TextColumn::make('deleted_at')->dateTime('d-M-Y')
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
            'index' => Pages\ListRestocks::route('/'),
            'create' => Pages\CreateRestock::route('/create'),
            'edit' => Pages\EditRestock::route('/{record}/edit'),
        ];
    }
}
