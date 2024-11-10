<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
    
            Log::info('External API Response:', ['response' => $response->body()]);
    
            if ($response->successful()) {
                $responseContent = $response->json('result.response');
    
                $user = Auth::user();
                $conversation = Conversation::create([
                    'user_id' => $user->id,
                    'title' => $userPrompt,
                ]);
    
                $mess =Message::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $user->id,
                    'content' => $responseContent,
                ]);
    
                return response()->json([
                    'success' => true,
                    'responseContent' => $responseContent,
                    'conversation' => $conversation,
                    'message' => $mess
                    
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing your request.'
                ], 500);
            }
        }

        
       
        
        public function showPreviousConversations(Request $request)
        {
            try {
                // If the user is not authenticated, throw an UnauthorizedHttpException
                if (!Auth::check()) {
                    throw new UnauthorizedHttpException('', 'Unauthorized - invalid or missing token.');
                }
        
                // Retrieve the authenticated user
                $user = Auth::user();
                
                // Fetch conversations with messages
                $conversations = Conversation::with('messages')->where('user_id', $user->id)->get();
        
                return response()->json([
                    'success' => true,
                    'conversations' => $conversations
                ], 200);
        
            } catch (UnauthorizedHttpException $e) {
                // Return a 401 response if there's an authentication issue
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 401);
            } catch (\Exception $e) {
                // Log the exception for debugging
                Log::error('Error fetching previous conversations:', ['error' => $e->getMessage()]);
        
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while fetching conversations.'
                ], 500);
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

        return response()->json([
            'success' => true,
            'message' => 'Conversation updated successfully.',
            'conversation' => $conversation
        ], 200);
    }

    public function deleteConversation($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Conversation deleted successfully.'
        ], 200);
    }

}
