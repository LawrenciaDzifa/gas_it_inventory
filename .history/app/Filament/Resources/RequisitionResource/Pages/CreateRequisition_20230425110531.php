<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;
//insert logged in user as the user who created the requisition and set the status to pending and save the requisition
    public static function actions(Actions $actions): Actions
    {
        return $actions
            ->saveAndCreateAnother()
            ->saveAndContinueEditing()
            ->saveAndExit()
            ->save(function ($record) {
                $record->user = Auth::user()->id;
                $record->status = 'pending';
                $record->save();
            });
    }
}
