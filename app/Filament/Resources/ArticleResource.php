<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Carbon\Carbon;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Konten';
    
    protected static ?string $navigationLabel = 'Artikel';
    
    protected static ?string $modelLabel = 'Artikel';
    
    protected static ?string $pluralModelLabel = 'Artikel';

    protected static ?string $recordTitleAttribute = 'title';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Artikel')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            ),
                            
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                            
                        FileUpload::make('thumbnail')
                            ->label('Gambar Thumbnail')
                            ->image()
                            ->directory('article-thumbnails')
                            ->columnSpanFull()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450'),
                            
                        RichEditor::make('excerpt')
                            ->label('Ringkasan')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(400),
                            
                        RichEditor::make('content')
                            ->label('Konten')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('article-attachments'),
                    ])
                    ->columns(2),
                    
                Section::make('Pengaturan Publikasi')
                    ->schema([
                        Select::make('category')
                            ->label('Kategori')
                            ->required()
                            ->options([
                                'Umum' => 'Umum',
                                'Tutorial' => 'Tutorial',
                                'Konversi Gambar' => 'Konversi Gambar',
                                'Konversi PDF' => 'Konversi PDF',
                                'Tips & Trik' => 'Tips & Trik',
                            ]),
                            
                        Select::make('user_id')
                            ->label('Penulis')
                            ->relationship('author', 'name')
                            ->required(),
                            
                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->seconds(false)
                            ->required()
                            ->default(now())
                            ->displayFormat('d M Y H:i')
                            ->timezone('Asia/Jakarta')
                            ->columnSpan(1),
                            
                        Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->default(false)
                            ->reactive()
                            ->afterStateUpdated(function($state, callable $set, $record, Forms\Get $get) {
                                $publishDate = $get('published_at');
                                if ($state && $publishDate) {
                                    $publishDateTime = $publishDate;
                                    if (is_string($publishDateTime)) {
                                        $publishDateTime = \Carbon\Carbon::parse($publishDateTime);
                                    }
                                    
                                    if ($publishDateTime->isFuture()) {
                                        $set('status', Article::STATUS_SCHEDULED);
                                        Notification::make()
                                            ->title('Artikel dijadwalkan untuk dipublikasikan')
                                            ->body('Artikel akan otomatis dipublikasikan pada ' . $publishDateTime->setTimezone('Asia/Jakarta')->format('d M Y H:i'))
                                            ->success()
                                            ->send();
                                    } else {
                                        $set('status', Article::STATUS_PUBLISHED);
                                    }
                                } else {
                                    $set('status', Article::STATUS_DRAFT);
                                }
                            }),
                        
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                Article::STATUS_DRAFT => 'Draft',
                                Article::STATUS_SCHEDULED => 'Terjadwal',
                                Article::STATUS_PUBLISHED => 'Dipublikasikan',
                            ])
                            ->default(Article::STATUS_DRAFT)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->circular(false)
                    ->square(),
                    
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                    
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),
                    
                TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable(),
                    
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => Article::STATUS_DRAFT,
                        'warning' => Article::STATUS_SCHEDULED,
                        'success' => Article::STATUS_PUBLISHED,
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Article::STATUS_DRAFT => 'Draft',
                        Article::STATUS_SCHEDULED => 'Terjadwal',
                        Article::STATUS_PUBLISHED => 'Dipublikasikan',
                        default => $state,
                    }),
                    
                TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
                    
                TextColumn::make('views')
                    ->label('Dilihat')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Umum' => 'Umum',
                        'Tutorial' => 'Tutorial',
                        'Konversi Gambar' => 'Konversi Gambar',
                        'Konversi PDF' => 'Konversi PDF',
                        'Tips & Trik' => 'Tips & Trik',
                    ]),
                    
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        Article::STATUS_DRAFT => 'Draft',
                        Article::STATUS_SCHEDULED => 'Terjadwal',
                        Article::STATUS_PUBLISHED => 'Dipublikasikan',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('cancelSchedule')
                    ->label('Batalkan Jadwal')
                    ->icon('heroicon-o-calendar-days')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Article $record) => $record->status === Article::STATUS_SCHEDULED)
                    ->action(function (Article $record) {
                        $record->update([
                            'is_published' => false,
                            'status' => Article::STATUS_DRAFT,
                        ]);
                        
                        Notification::make()
                            ->title('Jadwal publikasi dibatalkan')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
            'drafts' => Pages\ListDrafts::route('/drafts'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('author')
            ->orderBy('created_at', 'desc');
    }
}
