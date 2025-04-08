<?php

namespace App\Filament\Resources\ConversionStatisticResource\Pages;

use App\Filament\Resources\ConversionStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConversionStatistic extends EditRecord
{
    protected static string $resource = ConversionStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
