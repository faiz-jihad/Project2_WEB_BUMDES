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

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_penulis')
                ->relationship('penulis', 'nama_penulis')
                ->label('Penulis')
                ->required(),

            Forms\Components\Select::make('id_kategori')
                ->relationship('kategori', 'judul')
                ->label('Kategori')
                ->required(),

            Forms\Components\TextInput::make('judul')
                ->live(onBlur: true)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                ->required(),

            Forms\Components\TextInput::make('slug')
                ->readOnly()
                ->required(),

            Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->label('Thumbnail')
                ->columnSpanFull()
                ->required(),

            Forms\Components\RichEditor::make('Isi_berita')
                ->label('Konten Berita')
                ->columnSpanFull()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penulis.nama_penulis')
                    ->label('Penulis')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori.judul')
                    ->label('Kategori')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_penulis')
                    ->relationship('penulis', 'nama_penulis')
                    ->label('Penulis'),
                Tables\Filters\SelectFilter::make('id_kategori')
                    ->relationship('kategori', 'judul')
                    ->label('Kategori'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
