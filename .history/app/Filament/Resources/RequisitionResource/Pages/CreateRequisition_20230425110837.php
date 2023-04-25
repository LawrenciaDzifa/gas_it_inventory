<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;

    public static function actions(Actions $actions): Actions
    {
        return $actions
            ->saveAndCreateAnother()
            ->saveAndContinueEditing()
            ->saveAndExit()
            ->save(function ($record) {
                // Save the new record to the database first
                $record->save();

                // Set the user ID to the currently logged-in user's ID
                $record->user = Auth::id();

                // Set the status to "pending"
                $record->status = 'pending';

                // Save the modified record to the database
                $record->save();
            });
    }
}
