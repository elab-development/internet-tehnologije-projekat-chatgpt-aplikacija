<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function generateResponse(Request $request)
    {
        $apiToken = config('app.cloudflare.api_token'); 
        $url = config('app.cloudflare.url');

        Log::info('API Token:', ['token' => $apiToken]);
        Log::info('API URL:', ['url' => $url]);

        $userPrompt = $request->input('prompt');

        $data = [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a friendly assistant that helps write stories'
                ],
                [
                    'role' => 'user',
                    'content' => $userPrompt
                ]
            ]
        ];

        $response = Http::withToken($apiToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->timeout(60)
            ->post($url, $data);

        if ($response->successful()) {
            $responseContent = $response->json('result.response');
            if (Auth::check()) {
                
                $user = Auth::user();
                $conversation = Conversation::create([
                    'user_id' => $user->id,
                    'title' => $userPrompt, 
                ]);

                
                Message::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $user->id,
                    'content' => $responseContent,
                ]);

                $conversations = Conversation::with('messages')->where('user_id', $user->id)->get();

                return view('mainform', [
                    'responseContent' => $responseContent,
                    'conversations' => $conversations 
                ]);
            }

        } else {
            $responseContent = 'An error occurred while processing your request.';
        }

        return view('home', ['responseContent' => $responseContent]);
    }

    public function showPreviousConversations()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $conversations = Conversation::with('messages')->where('user_id', $user->id)->get();

            return view('mainform', [
                'conversations' => $conversations
            ]);
        }

    }


    public function editConversation(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $conversation = Conversation::findOrFail($id);
        $conversation->title = $request->input('title');
        $conversation->save();

        
        return redirect()->route('previous.conversations')->with('success', 'Conversation updated successfully.');
    }

    public function deleteConversation($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();

        return redirect()->route('previous.conversations')->with('success', 'Conversation deleted successfully.');
    }


    public function showMainForm()
    {
        return view('mainform');
    }
}
