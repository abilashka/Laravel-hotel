<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms;

class RoomsController extends Controller
{
   public function index()
    {
        return view('rooms.index');
    }

    public function show(Rooms $room)
    {
        return view('rooms.show', compact('room') );
    }
}
