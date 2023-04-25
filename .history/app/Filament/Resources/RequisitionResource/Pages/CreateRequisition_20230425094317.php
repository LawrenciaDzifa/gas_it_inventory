<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;
    protected function createRecord(): void
    {
        $record = $this->getRecord();

        // Set the user column to the logged-in user
        $record->user_id = Auth::id();

        parent::createRecord();
    }
}
