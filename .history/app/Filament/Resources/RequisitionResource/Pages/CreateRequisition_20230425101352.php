<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;
    protected function createRecord(): void
    {
        $record = $this->getRecord();
        // Set the user column to the ID of the logged-in user
        $record->setAttribute('user', Auth::user()->id);
                parent::createRecord();
    }
}
