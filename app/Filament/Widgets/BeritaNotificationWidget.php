<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class BeritaNotificationWidget extends BaseWidget
{
    protected static ?string $heading = 'Berita Terbaru';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Berita::query()
                    ->with(['penulis', 'kategoriBerita'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('Thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->height(40)
                    ->width(60)
                    ->square()
                    ->getStateUsing(function ($record) {
                        return $record->Thumbnail ? asset('storage/' . $record->Thumbnail) : null;
                    })
                    ->defaultImageUrl('/images/placeholder.jpg'),

                Tables\Columns\TextColumn::make('Judul')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('penulis.nama_penulis')
                    ->label('Penulis')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('kategoriBerita.Judul')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn(Berita $record): string => route('filament.admin.resources.beritas.edit', $record->id_berita))
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading('Belum ada berita')
            ->emptyStateDescription('Belum ada berita yang dibuat.')
            ->emptyStateIcon('heroicon-o-newspaper');
    }
}
