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
                // Create a new Requisition object with the specified attributes
                $record = new RequisitionResource([
                    'qty_requested' => $record->qty_requested,
                    'msg' => $record->msg,
                    'user' => Authid(),
                    'status' => 'pending',
                ]);

                // Save the new record to the database
                $record->save();
            });
    }
}
