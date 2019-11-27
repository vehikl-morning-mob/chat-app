<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\NewMessageReceived;
use App\Http\Requests\StoreMessageRequest;

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

    public function store(StoreMessageRequest $request): Response
    {
        $newMessage = $request->user()->messages()->create($request->validated());

        event(new NewMessageReceived($newMessage));

        return response(["message" => $newMessage->content], 201);
    }
}
