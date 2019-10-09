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

    public function store(Request $request): Response
    {
        Message::query()->create([
            'content' => $request->input('message'),
        ]);

        return response(["message" => $request->input('message')], 201);
    }
}
