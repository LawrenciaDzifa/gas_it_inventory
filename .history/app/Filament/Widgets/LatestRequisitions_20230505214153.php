<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestRequisitions extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Requisition::query()->latest();
        // ...

    }

    protected function getTableColumns(): array
    {
        return [
            Tables\
            // ...
        ];
    }
}
