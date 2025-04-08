<?php

namespace App\Filament\Resources\ConversionStatisticResource\Pages;

use App\Filament\Resources\ConversionStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConversionStatistics extends ListRecords
{
    protected static string $resource = ConversionStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
