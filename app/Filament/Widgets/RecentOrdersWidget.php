<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentOrdersWidget extends BaseWidget
{
    protected static ?string $heading = 'Pesanan Terbaru';
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pesanan::query()
                    ->with(['user'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id_pesanan')
                    ->label('ID Pesanan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('items')
                    ->label('Produk')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state) && count($state) > 0) {
                            $firstItem = $state[0];
                            return $firstItem['nama'] ?? 'Produk';
                        }
                        return 'Produk';
                    })
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (is_array($state) && count($state) > 0) {
                            $firstItem = $state[0];
                            return $firstItem['nama'] ?? 'Produk';
                        }
                        return 'Produk';
                    }),

                Tables\Columns\TextColumn::make('items')
                    ->label('Qty')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state) && count($state) > 0) {
                            $firstItem = $state[0];
                            return $firstItem['quantity'] ?? 1;
                        }
                        return 1;
                    })
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total')
                    ->money('IDR', true)
                    ->color('success'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Diterima',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn(Pesanan $record): string => route('filament.admin.resources.pesanans.edit', $record->id_pesanan))
                    ->openUrlInNewTab(),
            ])
            ->emptyStateHeading('Belum ada pesanan')
            ->emptyStateDescription('Belum ada pesanan yang diterima.')
            ->emptyStateIcon('heroicon-o-shopping-cart');
    }
}
