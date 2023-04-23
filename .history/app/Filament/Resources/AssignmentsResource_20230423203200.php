<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentsResource\Pages;
use App\Filament\Resources\AssignmentsResource\RelationManagers;
use App\Models\Assignments;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssignmentsResource extends Resource
{
    protected static ?string $model = Assignments::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Inventory Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('Item name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Serial number')->required()->maxLength(64),
                TextInput::make('Quantity assigned')->required()->maxLength(64),
                TextInput::make('Assined to')->required()->maxLength(64),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('Item name')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Serial number')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Quantity assigned')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Assigned to')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->dateTime('d-M-Y'),

            ])
            ->filters([
                //
            ])
            ->actions([
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
            'create' => Pages\CreateAssignments::route('/create'),
            'edit' => Pages\EditAssignments::route('/{record}/edit'),
        ];
    }
}
