<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function track(Request $request)
    {
        $request->validate([
            'event' => 'required|string',
            'data' => 'nullable|array',
        ]);

        Event::track($request->event, null, auth()->id(), $request->data);

        return response()->json(['status' => 'success']);
    }
}
