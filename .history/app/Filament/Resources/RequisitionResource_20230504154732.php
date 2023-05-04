<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequisitionResource\Pages;
use App\Http\Controllers\SMSController;
use App\Models\Item;
use App\Models\Requisition;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Textarea as ComponentsTextarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
                    ->required()
                    ->disablePlaceholderSelection(),
                TextInput::make('qty_requested')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100),
                ComponentsTextarea::make('msg')
                    ->required()
                    ->maxLength(255),
            ]);
    }
    public static function table(Table $table): Table
    {
        // return a table where the requisitions belong to the logged in user
        return $table
            ->columns([
                TextColumn::make('item_name')
                    ->searchable()
                    ->sortable()
                    ->format(function ($value, $record) {
                        return Item::find($record->item_name)->name;
                    }),
                TextColumn::make('qty_requested')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('msg')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->format(function ($value, $record) {
                        if ($record->status == 'pending') {
                            return '<span class="badge bg-warning">Pending</span>';
                        } elseif ($record->status == 'approved') {
                            return '<span class="badge bg-success">Approved</span>
                ';
                        } elseif ($record->status == 'declined') {
                            return '<span class="badge bg-danger">Declined</span>';
                        }
                    }),
                TextColumn::make('user')
                    ->searchable()
                    ->sortable()
                    ->format(function ($value, $record) {
                        return User::find($record->user)->name;
                    }),
                TextColumn::make('created_at')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->sortable(),
            ])


            ->query(function ($query) {
                if (Auth::user()->role == 'admin') {
                    return $query;
                } else {
                    return $query->where('user', Auth::user()->id);
                }
            })
            ->filters([
                //
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success'),
                Action::make('decline')
                    ->label('Decline')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger'),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
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
