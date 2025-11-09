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
        $creator = auth()->user();

        // Send notification to all users
        $allUsers = User::all();
        foreach ($allUsers as $user) {
            $user->notify(new ProductUpdated($produk, $creator, 'created'));
        }
    }
}
