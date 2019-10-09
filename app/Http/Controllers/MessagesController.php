<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessagesController extends Controller
{
    public function index(Request $request): Response
    {
        return response(["messages" => Message::query()->pluck('content')], 200);
    }
}
