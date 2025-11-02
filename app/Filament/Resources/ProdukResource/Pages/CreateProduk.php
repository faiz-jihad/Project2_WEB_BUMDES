<?php

namespace App\Filament\Resources\ProdukResource\Pages;

use App\Filament\Resources\ProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Notifications\ProductUpdated;
use App\Models\User;

class CreateProduk extends CreateRecord
{
    protected static string $resource = ProdukResource::class;

    protected function afterCreate(): void
    {
        $produk = $this->record;
        $user = auth()->user();

        // Send notification to admin users
        $adminUsers = User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(new ProductUpdated($produk, $user, 'created'));
        }
    }
}
