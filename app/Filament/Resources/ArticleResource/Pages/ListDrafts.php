<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDrafts extends ListRecords
{
    protected static string $resource = ArticleResource::class;
    
    protected static ?string $title = 'Draft & Artikel Terjadwal';
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    
    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->draftSection(); // Menggunakan scope draftSection yang sudah kita definisikan
    }
} 