<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentResource\Pages;
use App\Filament\Resources\AssignmentResource\RelationManagers;
use App\Models\Assignment;
use App\Models\Item;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-table';
    protected static ?string $navigationGroup = 'Inventory Management';
    public static function getEloquentQuery(): Builder
    {
        if (Auth::user()->role == 'admin') {
            return parent::getEloquentQuery();
        } else {
            return parent::getEloquentQuery()->where('assigned_to', Auth::user()->id);
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('item_name')
                    ->options(
                        Item::all()->pluck('name', 'id')
                    )
                    ->required()
                    ->disablePlaceholderSelection(),
                Forms\Components\TextInput::make('serial_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qty_assigned')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(100),
                Forms\Components\Select::make('assigned_to')
                    ->options(
                        User::all()->pluck('name', 'id')
                    )
                    ->required()
                    ->disablePlaceholderSelection(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('item_name')->getStateUsing(function (Model $record) {
                    $item = Item::find($record->item_name);
                    return $item ? $item->name : 'Unknown';
                }),
                Tables\Columns\TextColumn::make('serial_number'),
                Tables\Columns\TextColumn::make('qty_assigned'),
                Tables\Columns\TextColumn::make('assigned_to')->getStateUsing(function (Model $record) {
                    $user = User::find($record->assigned_to);
                    return $user ? $user->name : 'Unknown';
                }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-Y'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('assigned_to')
                    ->options(
                        User::all()->pluck('name', 'id')
                    )
                    ->label('Assigned To')
                    ->placeholder('All Users'),
            ])
            ->actions([
                if
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
    }
}
