<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequisitionResource\Pages;
use App\Filament\Resources\RequisitionResource\RelationManagers;
use App\Models\Requisition;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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

                TextInput::make('item_name')
                    ->required()
                    ->maxLength(255),
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
                TextColumn::make('user')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('item_name'),
                TextColumn::make('qty_requested'),
                TextColumn::make('msg'),
                // TextColumn::make('status'),
                // wrap the status column in labels such that the status is displayed as a badge, where approves is green, pending is yellow and declined is red, using getStateUsing method
                TextColumn::make('status')
                    ->getStateUsing(function (Model $record) {
                        if ($record->status == 'approved') {
                            return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">' . $record->status . '</span>';
                        } elseif ($record->status == 'pending') {
                            return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">' . $record->status . '</span>';
                        } elseif ($record->status == 'declined') {
                            return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">' . $record->status . '</span>';
                        }
                    }),







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
