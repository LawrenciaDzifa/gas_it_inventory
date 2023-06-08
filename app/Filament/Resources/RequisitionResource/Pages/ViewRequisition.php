<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRequisition extends ViewRecord
{
    protected static string $resource = RequisitionResource::class;

    protected function getActions(): array
    {
        return [
            //     edit if status is pending
            Actions\EditAction::make()->visible(function () {
                return $this->record->status == 'pending' ;
            }),
        ];
    }
}
