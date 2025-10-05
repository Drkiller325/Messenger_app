<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $user->conversations()->with([
            'lastMessage',
            'participants' => function ($builder) use ($user) {
                $builder->where('id', '<>', $user->id);
            }])->paginate();
    }

    public function show(Conversation $conversation)
    {
        return $conversation->load('participants'); // to return the conversation object with the participants not only them
    }

    public function addParicipant(Request $request, Conversation $conversation)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id', 'int'],
        ]);

        $conversation->participants()->attach($request->post('user_id'), [ //to access the post data only not any data like when using $request->user_id
            'joined_at' => Carbon::now()
            ]);
    }

    public function removeParicipant(Request $request, Conversation $conversation)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id', 'int'],
        ]);

        $conversation->participants()->detach($request->post('user_id'));
    }
}
