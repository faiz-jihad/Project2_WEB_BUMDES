<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pesanan;
use Carbon\Carbon;

class DeleteUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:delete-unpaid {--hours=2 : Hours after which unpaid orders should be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unpaid orders that are older than specified hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hours = $this->option('hours');

        $this->info("Deleting unpaid orders older than {$hours} hours...");

        // Find unpaid orders older than specified hours
        $cutoffTime = Carbon::now()->subHours($hours);

        $unpaidOrders = Pesanan::where('status', 'pending')
            ->where('created_at', '<', $cutoffTime)
            ->get();

        $count = $unpaidOrders->count();

        if ($count === 0) {
            $this->info('No unpaid orders found to delete.');
            return;
        }

        // Delete the orders
        foreach ($unpaidOrders as $order) {
            $this->line("Deleting order #{$order->id_pesanan} (created: {$order->created_at})");
            $order->delete();
        }

        $this->info("Successfully deleted {$count} unpaid orders.");
    }
}
