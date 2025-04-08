<?php

namespace App\Filament\Resources\ConvertedImageResource\Pages;

use App\Filament\Resources\ConvertedImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConvertedImage extends EditRecord
{
    protected static string $resource = ConvertedImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
