<?php

namespace App\Filament\Resources\RequisitionResource\Pages;

use App\Filament\Resources\RequisitionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateRequisition extends CreateRecord
{
    protected static string $resource = RequisitionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user'] = auth()->id();
    $data['status'] = 'Pending';
    $data['item_name'] = $data['item_name'];
    

    return $data;
}

}
