<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ViewTrackingService;

class ViewController extends Controller
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    public function track(Request $request, $type, $id)
    {
        $request->validate([
            'type' => 'required|in:berita,produk',
            'id' => 'required|integer',
        ]);

        $this->viewTrackingService->trackView($type, $id, $request->ip());

        return response()->json(['status' => 'success']);
    }
}
