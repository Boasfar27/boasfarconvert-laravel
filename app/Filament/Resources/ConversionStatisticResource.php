<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConversionStatisticResource\Pages;
use App\Filament\Resources\ConversionStatisticResource\RelationManagers;
use App\Models\ConversionStatistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConversionStatisticResource extends Resource
{
    protected static ?string $model = ConversionStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Statistik Konversi';
    protected static ?string $modelLabel = 'Statistik Konversi';
    protected static ?string $pluralModelLabel = 'Statistik Konversi';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('conversion_type')
                    ->label('Tipe Konversi')
                    ->options([
                        'image' => 'Gambar',
                        'pdf_to_word' => 'PDF ke Word',
                        'word_to_pdf' => 'Word ke PDF',
                    ])
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('original_filename')
                    ->label('File Asli')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('converted_filename')
                    ->label('File Hasil')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('original_size')
                    ->label('Ukuran Asli')
                    ->maxLength(255),
                Forms\Components\TextInput::make('converted_size')
                    ->label('Ukuran Hasil')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ip_address')
                    ->label('Alamat IP')
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_agent')
                    ->label('User Agent')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('conversion_type')
                    ->label('Tipe Konversi')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'image' => 'Gambar',
                        'pdf_to_word' => 'PDF ke Word',
                        'word_to_pdf' => 'Word ke PDF',
                        default => $state,
                    })
                    ->badge()
                    ->colors([
                        'primary' => 'image',
                        'success' => 'pdf_to_word',
                        'warning' => 'word_to_pdf',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('original_filename')
                    ->label('File Asli')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('converted_filename')
                    ->label('File Hasil')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('original_size')
                    ->label('Ukuran Asli'),
                Tables\Columns\TextColumn::make('converted_size')
                    ->label('Ukuran Hasil'),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('Alamat IP')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('conversion_type')
                    ->label('Tipe Konversi')
                    ->options([
                        'image' => 'Gambar',
                        'pdf_to_word' => 'PDF ke Word',
                        'word_to_pdf' => 'Word ke PDF',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConversionStatistics::route('/'),
            'create' => Pages\CreateConversionStatistic::route('/create'),
            'edit' => Pages\EditConversionStatistic::route('/{record}/edit'),
        ];
    }
}
