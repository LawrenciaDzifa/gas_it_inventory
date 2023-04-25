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
    dd($data)
    $data['user'] = auth()->id();
    $data['status'] = 'Pending';
    $data['item_name'] = $data[' item_name'];
    $data['qty_requested'] = $data['qty_requested'];
    $data['msg'] = $data['msg'];

    return $data;
}

}
