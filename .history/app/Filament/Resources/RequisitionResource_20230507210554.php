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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;


class RequisitionResource extends Resource
{
    protected static ?string $model = Requisition::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Inventory Management';

public static function getEloquentQuery(): Builder
{
    if (Auth::user()->role == 'admin') {
        return parent::getEloquentQuery();
    } else {
        return parent::getEloquentQuery()->where('user', Auth::user()->id);
    }
}

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

    public static function afterCreate(Form $form,)
    {
        $requisition = $form->getRecord();

        $sms = new SMSController();
        $phone = Auth::user()->phone;
        $msg = 'Your requisition of ' . $requisition->item_name . 'has been received and is pending approval. You will be notified once it is approved.';
        $sms->sendSMS($phone, $msg);
        Flash::success('Requisition created successfully');
        return redirect()->route('requisitions.index');
    }


    public static function table(Table $table): Table

    {
        return $table


            ->columns([
                TextColumn::make('id'),
                TextColumn::make('user')
                    ->searchable()->getStateUsing(function (Model $record) {
                        return User::find($record->user)->name;
                    }),
                TextColumn::make('item_name')->getStateUsing(function (Model $record) {
                    return Item::find($record->item_name)->name;
                }),
                TextColumn::make('qty_requested'),
                TextColumn::make('msg'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-Y'),
                BadgeColumn::make('status')
                    ->enum([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'declined' => 'Declined',
                    ])
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'declined',
                    ])->searchable(),


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->options(
                        User::all()->pluck('name', 'id')
                    )
                    ->label('User')
                    ->placeholder('All Users')
                    ->default(null),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'declined' => 'Declined',
                    ])
                    ->label('Status')
                    ->placeholder('All Statuses')
                    ->default(null),

            ])
            ->actions([
                

                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ,


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
