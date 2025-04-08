<?php

namespace App\Filament\Widgets;

use App\Models\ConversionStatistic;
use App\Models\ConvertedImage;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConversionStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah semua pengguna')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            
            Stat::make('Total Premium', User::where('role', 1)->count())
                ->description('Jumlah pengguna premium')
                ->descriptionIcon('heroicon-m-star')
                ->chart([3, 1, 4, 2, 5, 3, 7])
                ->color('warning'),
            
            Stat::make('Total Konversi Gambar', ConvertedImage::count())
                ->description('Jumlah gambar yang dikonversi')
                ->descriptionIcon('heroicon-m-photo')
                ->chart([15, 20, 18, 25, 22, 30, 35])
                ->color('primary'),
                
            Stat::make('Konversi PDF & Word', ConversionStatistic::where('conversion_type', 'pdf_to_word')
                ->orWhere('conversion_type', 'word_to_pdf')
                ->count())
                ->description('Jumlah konversi dokumen')
                ->descriptionIcon('heroicon-m-document')
                ->chart([3, 5, 7, 6, 9, 8, 10])
                ->color('danger'),
        ];
    }
}
