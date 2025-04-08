<?php

namespace App\Filament\Resources\ConvertedImageResource\Pages;

use App\Filament\Resources\ConvertedImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConvertedImages extends ListRecords
{
    protected static string $resource = ConvertedImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
