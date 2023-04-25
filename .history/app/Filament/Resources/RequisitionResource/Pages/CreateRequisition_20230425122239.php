<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;


    // set logged in user as user column and set the status to pending and save record
    public static function beforeSave($record)
    {
        $record->user = Aut::user()->id;
        $record->status = 'pending';
        $record->save();
    }

}
