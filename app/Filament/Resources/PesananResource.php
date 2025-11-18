<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use App\Notifications\PesananStatusUpdated;
use App\Models\User;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Pesanan';

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->label('User'),

                Forms\Components\TextInput::make('nama_pemesan')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Pemesan'),

                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->maxLength(500)
                    ->label('Alamat'),

                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(20)
                    ->label('No. HP'),

                Forms\Components\Select::make('metode_pembayaran')
                    ->options([
                        'transfer' => 'Transfer Bank',
                        'cod' => 'Bayar di Tempat',
                    ])
                    ->required()
                    ->label('Metode Pembayaran'),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Menunggu Pembayaran',
                        'sudah_bayar' => 'Sudah Bayar',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->required()
                    ->label('Status'),

                Forms\Components\Textarea::make('catatan')
                    ->maxLength(500)
                    ->label('Catatan'),

                Forms\Components\Placeholder::make('total_harga')
                    ->label('Total Harga')
                    ->content(fn($record) => $record ? 'Rp ' . number_format($record->total_harga, 0, ',', '.') : '-'),

                Forms\Components\Placeholder::make('items')
                    ->label('Items')
                    ->content(function ($record) {
                        if (!$record || !is_array($record->items)) return '-';

                        $itemsText = '';
                        foreach ($record->items as $item) {
                            $itemsText .= "- {$item['nama']} (x{$item['jumlah']}) - Rp " . number_format($item['subtotal'], 0, ',', '.') . "\n";
                        }
                        return $itemsText;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_pesanan')
                    ->label('ID Pesanan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('items')
                    ->label('Daftar Barang')
                    ->formatStateUsing(function ($state) {
                        if (blank($state)) {
                            return '-';
                        }

                        // Decode sekali (karena string JSON tunggal)
                        $item = json_decode($state, true);

                        // Jika gagal decode, berhenti
                        if (!is_array($item)) {
                            return '-';
                        }

                        // Ambil data
                        $nama = $item['nama'] ?? '-';
                        $jumlah = $item['jumlah'] ?? 0;
                        $subtotal = $item['subtotal'] ?? 0;

                        // Format tampilan
                        return "{$nama} ({$jumlah}x) - Rp" . number_format($subtotal, 0, ',', '.');
                    })
                    ->wrap()
                    ->sortable(),
                TextColumn::make('nama_pemesan')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Guest'),

                TextColumn::make('total_harga')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => ['sudah_bayar', 'selesai'],
                        'info' => 'diproses',
                        'primary' => 'dikirim',
                        'danger' => 'dibatalkan',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Menunggu Pembayaran',
                        'sudah_bayar' => 'Sudah Bayar',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                        default => $state,
                    }),

                TextColumn::make('metode_pembayaran')
                    ->label('Pembayaran')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'transfer' => 'Transfer Bank',
                        'cod' => 'Bayar di Tempat',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal Pesan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu Pembayaran',
                        'sudah_bayar' => 'Sudah Bayar',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->label('Status'),

                SelectFilter::make('metode_pembayaran')
                    ->options([
                        'transfer' => 'Transfer Bank',
                        'cod' => 'Bayar di Tempat',
                    ])
                    ->label('Metode Pembayaran'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('update_status')
                    ->label('Update Status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Menunggu Pembayaran',
                                'sudah_bayar' => 'Sudah Bayar',
                                'diproses' => 'Diproses',
                                'dikirim' => 'Dikirim',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->required()
                            ->label('Status Baru'),
                    ])
                    ->action(function (Pesanan $record, array $data): void {
                        $oldStatus = $record->status;
                        $record->update(['status' => $data['status']]);

                        Notification::make()
                            ->title('Status pesanan berhasil diperbarui')
                            ->success()
                            ->send();

                        // Kirim notifikasi ke user
                        if ($record->user) {
                            $record->user->notify(new PesananStatusUpdated($record, $oldStatus, $data['status']));
                        }
                    }),
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
