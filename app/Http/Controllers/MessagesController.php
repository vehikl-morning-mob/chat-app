<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessagesController extends Controller
{
    public function index(Request $request): Response
    {
        return response(
            Message::all()->map(function ($message) {
                return [
                    'message' => $message->content,
                    'user' => $message->user->name,
                ];
            }),
            200);
    }

    public function store(Request $request): Response
    {
        $request->user()->messages()->create(['content' => $request->input('message')]);

        return response(["message" => $request->input('message')], 201);
    }
}
