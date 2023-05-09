<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequisitionResource\Pages;
use App\Http\Controllers\SMSController;
use App\Models\Item;
use App\Models\Requisition;
use App\Models\User;
use FFI;
use Filament\Forms;
use Filament\Forms\Components\Textarea as ComponentsTextarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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
use Twilio\Rest\Notify;

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
                    ->action(
                        // update the status of the requisition to approved
                        function (Model $record) {
                            // check the status of the requisition, if it is already approved, do nothing, if it is pending, update it to approved,if it is denied, show a popup message that it has been denied
                            if ($record->status == 'approved') {
                                // show a modal that the requisition has already been approved
                                Notification::make()
                                    ->title('Requisition Already Approved')
                                    ;
                                ;
                            } elseif ($record->status == 'declined') {
                                // show a modal that the requisition has already been approved
                                Notification::make()
                                    ->title('Requisition Already Declined');
                            } else {
                                $record->update([
                                    'status' => 'approved',


                                ]);
                                // update stock qty in stock table by subtracting qty_requested
                                $item = Item::find($record->item_name);
                                
                                Flash::success('Requisition approved successfully.');
                                // send sms to the user that the requisition has been approved
                                $user = User::find($record->user);
                                $phoneNumber = $user->phone;
                                $userName = $user->name;
                                $msg = 'Hello ' . $userName . ', your requisition has been approved. Kindly pick up you item(s) from the store. Thank you.';
                                $sms = new SMSController();
                                $sms->sendSMS($msg, $phoneNumber);
                            }

                            ;
                            $user = Auth::user();
                            $phoneNumber = $user->phone;
                            $userName = $user->name;
                            $msg = 'Hello ' . $userName . ', your requisition has been approved. Kindly pick up you item(s) from the store. Thank you.';
                            $sms = new SMSController();
                            $sms->sendSMS($msg, $phoneNumber);
                        }
                    )

                    ->visible(auth()->user()->role == 'admin'),
                Action::make('decline')
                    ->label('Decline')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(
                        // update the status of the requisition to approved
                        function (Model $record) {
                            $record->update([
                                'status' => 'declined',
                            ]);
                        }
                    )
                    ->visible(auth()->user()->role == 'admin'),
                Actions\EditAction::make()->visible(auth()->user()->role == 'admin'),
                Actions\DeleteAction::make()->visible(auth()->user()->role == 'admin'),
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
