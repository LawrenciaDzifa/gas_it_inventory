<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Admin Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                // Forms\Components\TextInput::make('role')
                //     ->required()
                //     ->maxLength(255),
                Select::make('roles')->relationship('roles', 'name')->preload()->multiple()->required(),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('role'),
                TextColumn::make('email_verified_at')
                    ->dateTime('d-M-Y'),
                TextColumn::make('created_at')
                    ->dateTime('d-M-Y'),
                TextColumn::make('updated_at')
                    ->dateTime('d-M-Y'),
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
        $pages = [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];

        // check if the currently logged-in user is an admin, and if not, remove the 'Admin Management' navigation group
        if (Auth::user()->role != 'admin) {
            unset($pages['index']); // remove the index page
            unset($pages['create']); // remove the create page
            unset($pages['edit']); // remove the edit page

            // if the current page is one of the admin management pages, redirect to the dashboard
            if (in_array(request()->route()->getName(), array_keys($pages))) {
                redirect('/dashboard');
            }
        }

        return $pages;
    }

}
