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
use Filament\Tables\Actions;
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
                Forms\Components\Select::make('item_name')
                    ->options(
                        Item::all()->pluck('name', 'id')
                    )
                    ->required(),
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
                TextColumn::make('status')
                    ->getStateUsing(function (Model $record) {
                        $status = $record->status;
                        $color = 'bg-gray-200 text-gray-800';
                        if ($status == 'approved') {
                            $color = 'bg-green-200 text-green-800';
                        } elseif ($status == 'pending') {
                            $color = 'bg-yellow-200 text-yellow-800';
                        } elseif ($status == 'declined') {
                            $color = 'bg-red-200 text-red-800';
                        }
                        return '<span class="inline-flex items-center px-2 py-1 rounded text-sm font-medium ' . $color . '">' . $status . '</span>';
                    })
                    ->html(),
                    Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-Y'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
                // make an approve action
                

                // Actions\Action::make('approve')
                //     ->label('Approve')
                //     ->button()
                //     ->icon('heroicon-o-check-circle')
                //     ->variant('success')
                //     ->confirm('Are you sure you want to approve this requisition?')
                //     ->handler(function ($record) {
                //         // Update the status of the requisition to 'approved'
                //         $record->update(['status' => 'approved']);
                //     }),
                // Actions\Action::make('decline')
                //     ->label('Decline')
                //     ->button()
                //     ->variant('danger')
                //     ->confirm('Are you sure you want to decline this requisition?')
                //     ->handler(function ($record) {
                //         // Update the status of the requisition to 'declined'
                //         $record->update(['status' => 'declined']);
                //     }),
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
