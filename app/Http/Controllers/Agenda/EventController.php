<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Untuk Halaman List/Data Table
    public function index() {
        $events = Event::orderBy('event_date', 'desc')->get();
        return view('admin.pages.events.index', compact('events'));
    }

    // API untuk TUI Calendar
    public function getJson() {
        return response()->json(Event::all());
    }

    public function store(Request $request) {
        $event = Event::create($request->all());
        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }

    public function update(Request $request, Event $event) {
        $event->update($request->all());
        return response()->json(['status' => 'success']);
    }

    public function destroy(Event $event) {
        $event->delete();
        return redirect()->back()->with('success', 'Event dihapus!');
    }
}