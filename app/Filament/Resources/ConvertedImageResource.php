<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConvertedImageResource\Pages;
use App\Filament\Resources\ConvertedImageResource\RelationManagers;
use App\Models\ConvertedImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConvertedImageResource extends Resource
{
    protected static ?string $model = ConvertedImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Gambar Dikonversi';
    protected static ?string $modelLabel = 'Gambar Dikonversi';
    protected static ?string $pluralModelLabel = 'Gambar Dikonversi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name'),
                Forms\Components\TextInput::make('original_filename')
                    ->label('Nama File Asli')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('original_path')
                    ->label('Path File Asli')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('converted_filename')
                    ->label('Nama File Hasil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('converted_path')
                    ->label('Path File Hasil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('conversion_type')
                    ->label('Tipe Konversi')
                    ->required()
                    ->default('webp')
                    ->maxLength(255),
                Forms\Components\TextInput::make('original_size')
                    ->label('Ukuran Asli')
                    ->maxLength(255),
                Forms\Components\TextInput::make('converted_size')
                    ->label('Ukuran Hasil')
                    ->maxLength(255),
                Forms\Components\TextInput::make('compression_ratio')
                    ->label('Rasio Kompresi')
                    ->numeric(),
                Forms\Components\Section::make('Preview Gambar')
                    ->schema([
                        Forms\Components\ViewField::make('original_image')
                            ->label('Gambar Asli')
                            ->view('filament.resources.converted-image-resource.components.image-preview')
                            ->viewData(fn ($record) => [
                                'url' => $record?->original_path,
                                'name' => $record?->original_filename,
                            ]),
                        Forms\Components\ViewField::make('converted_image')
                            ->label('Gambar Hasil')
                            ->view('filament.resources.converted-image-resource.components.image-preview')
                            ->viewData(fn ($record) => [
                                'url' => $record?->converted_path,
                                'name' => $record?->converted_filename,
                            ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('converted_path')
                    ->label('Preview')
                    ->circular(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->sortable(),
                Tables\Columns\TextColumn::make('original_filename')
                    ->label('File Asli')
                    ->searchable(),
                Tables\Columns\TextColumn::make('converted_filename')
                    ->label('File Hasil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('formatted_original_size')
                    ->label('Ukuran Asli'),
                Tables\Columns\TextColumn::make('formatted_converted_size')
                    ->label('Ukuran Hasil'),
                Tables\Columns\TextColumn::make('compression_percentage')
                    ->label('Kompresi')
                    ->formatStateUsing(fn ($state) => $state . '%'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('conversion_type')
                    ->label('Tipe')
                    ->badge(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListConvertedImages::route('/'),
            'create' => Pages\CreateConvertedImage::route('/create'),
            'edit' => Pages\EditConvertedImage::route('/{record}/edit'),
        ];
    }
}
