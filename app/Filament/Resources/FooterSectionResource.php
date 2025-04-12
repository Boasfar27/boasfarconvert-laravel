<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterSectionResource\Pages;
use App\Filament\Resources\FooterSectionResource\RelationManagers;
use App\Models\FooterSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FooterSectionResource extends Resource
{
    protected static ?string $model = FooterSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Footer';
    protected static ?string $modelLabel = 'Footer';
    protected static ?string $pluralModelLabel = 'Footer';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(FooterSection::class, 'slug', ignoreRecord: true),
                Forms\Components\RichEditor::make('content')
                    ->label('Isi Konten')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
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
            'index' => Pages\ListFooterSections::route('/'),
            'create' => Pages\CreateFooterSection::route('/create'),
            'edit' => Pages\EditFooterSection::route('/{record}/edit'),
        ];
    }
}
