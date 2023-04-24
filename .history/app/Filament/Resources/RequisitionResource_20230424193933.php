<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequisitionResource\Pages;
use App\Filament\Resources\RequisitionResource\RelationManagers;
use App\Models\Item;
use App\Models\Requisition;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

use Laravel\Nova\Fields\Text;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequisitionResource extends Resource
{
    protected static ?string $model = Requisition::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Inventory Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                // the item name should be a select from dropdown of items
                Forms\Components\Select::make('Item name')
                    ->options(
                        Item::all()->pluck('name', 'id')
                    )
                    ->required(),


                // TextInput::make('item_name')
                //     ->required()
                //     ->maxLength(255),
                TextInput::make('qty_requested')
                    ->integer()
                    ->required(),
                TextInput::make('msg')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('user')->sortable()
                    ->searchable()->getStateUsing(function (Model $record) {
                        return User::find($record->user)->name;
                    }),

                TextColumn::make('item_name')->getStateUsing(function (Model $record) {
                    return Item::find($record->item_name)->name;
                }),
                TextColumn::make('qty_requested'),
                TextColumn::make('msg'),
                // TextColumn::make('status'),
                // wrap the status column in labels such that the status is displayed as a badge, whre the badge color is green when the status is approved, red  when it is declined and yellow when the status is pending
                TextColumn::make('status')->sortable()
                    ->searchable()
                    ->getStateUsing(function (Model $record) {
                        $status = $record->status;
                        $color = 'bg-gray-200 text-gray-800';
                        if ($status == 'approved') {
                            $color = 'bg-green-200 text-green-800';
                        } else if ($status == 'pending') {
                            $color = 'bg-yellow-200 text-yellow-800';
                        } else if ($status == 'declined') {
                            $color = 'bg-red-200 text-red-800';
                        }
                        return '<span class="inline-flex items-center px-2 py-1 rounded text- font-medium ' . $color . '">' . $status . '</span>';
                    })->html()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListRequisitions::route('/'),
            'create' => Pages\CreateRequisition::route('/create'),
            'edit' => Pages\EditRequisition::route('/{record}/edit'),
        ];
    }
}
