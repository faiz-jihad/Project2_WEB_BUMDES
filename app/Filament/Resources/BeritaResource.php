<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Berita';
    protected static ?string $pluralModelLabel = 'Edit Berita';
    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // ====== Penulis ======
            Forms\Components\Select::make('id_penulis')
                ->relationship('penulis', 'nama_penulis')
                ->label('Penulis')
                ->searchable()
                ->preload()
                ->required(),

            // ====== Kategori ======
            Forms\Components\Select::make('id_kategori')
                ->relationship('kategori', 'judul')
                ->label('Kategori')
                ->searchable()
                ->preload()
                ->required(),

            // ====== Judul & Slug ======
            Forms\Components\TextInput::make('judul')
                ->label('Judul')
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->maxLength(255)
                ->required(),

            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->unique(Berita::class, 'slug', ignoreRecord: true)
                ->maxLength(255)
                ->required(),

            // ====== Thumbnail Upload ======
            Forms\Components\FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->directory('thumbnails')
                ->preserveFilenames()
                ->maxSize(2048)
                ->imageResizeMode('contain')
                ->imageCropAspectRatio(null)
                ->imageResizeTargetWidth(null)
                ->imageResizeTargetHeight(null)
                ->deletable(true)
                ->downloadable(true)
                ->openable(true)
                ->imageEditor()
                ->columnSpanFull()
                ->helperText('Ukuran maksimal: 2MB. Format: JPG, PNG, WEBP')
                ->required(),

            // ====== Konten ======
            Forms\Components\RichEditor::make('isi_berita')
                ->label('Konten Berita')
                ->columnSpanFull()
                ->required()
                ->default('Isi berita belum tersedia.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ====== ID (debug) ======
                Tables\Columns\TextColumn::make('id_berita')
                    ->label('ID')
                    ->sortable(),

                // ====== Thumbnail Column ======
                Tables\Columns\ImageColumn::make('Thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->height(60)
                    ->width(80)
                    ->square()
                    ->visibility('public'),

                // ====== Judul ======
                Tables\Columns\TextColumn::make('Judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->wrap()
                    ->limit(100),

                // ====== Slug ======
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->limit(50),

                // ====== Kategori ======
                Tables\Columns\TextColumn::make('kategori.Judul')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->default('-'),

                // ====== Penulis ======
                Tables\Columns\TextColumn::make('penulis.nama_penulis')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-user')
                    ->iconColor('primary')
                    ->default('-'),

                // ====== Created At ======
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('id_penulis')
                    ->relationship('penulis', 'nama_penulis')
                    ->label('Penulis')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                Tables\Filters\SelectFilter::make('id_kategori')
                    ->relationship('kategori', 'judul')
                    ->label('Kategori')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dibuat dari'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Dibuat sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = 'Dibuat dari ' . \Carbon\Carbon::parse($data['created_from'])->format('d M Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = 'Dibuat sampai ' . \Carbon\Carbon::parse($data['created_until'])->format('d M Y');
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('Belum ada berita')
            ->emptyStateDescription('Mulai dengan membuat berita pertama Anda.')
            ->emptyStateIcon('heroicon-o-newspaper')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Berita')
                    ->icon('heroicon-o-plus'),
            ])
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getRouteKeyName(): ?string
    {
        return 'id_berita';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record:id_berita}/edit'),
        ];
    }
}
