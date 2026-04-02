<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory;
use App\Models\ChatbotSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ChatbotController extends Controller
{
    public function index()
    {
        $chatHistory = [];
        if (Session::has('user_id')) {
            $chatHistory = ChatHistory::where('user_id', Session::get('user_id'))
                ->orderBy('created_at', 'asc') // Changed to 'asc' for chronological order
                ->get();
        }
        return view('chatbot', compact('chatHistory'));
    }
    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000'
        ]);
        
        $userMessage = $request->message;
        
        // Get settings from database
        $settings = ChatbotSetting::all();
        $ollamaUrl = 'http://localhost:11434'; // Force default
        $model = 'llama2'; // Force default model
        
        // Try to get from settings if available
        foreach ($settings as $setting) {
            if ($setting->setting_key === 'ollama_api_url') {
                $ollamaUrl = $setting->setting_value;
            }
            if ($setting->setting_key === 'ollama_model') {
                $model = $setting->setting_value;
            }
        }
        
        try {
            // First, check if model exists
            $tagsResponse = Http::timeout(5)->get($ollamaUrl . '/api/tags');
            $availableModels = $tagsResponse->json();
            
            $modelExists = false;
            if (isset($availableModels['models'])) {
                foreach ($availableModels['models'] as $availableModel) {
                    if ($availableModel['name'] === $model || strpos($availableModel['name'], $model) === 0) {
                        $modelExists = true;
                        $model = $availableModel['name']; // Use exact model name
                        break;
                    }
                }
            }
            
            if (!$modelExists) {
                // Try to use first available model
                if (isset($availableModels['models'][0]['name'])) {
                    $model = $availableModels['models'][0]['name'];
                } else {
                    throw new \Exception('No models found in Ollama. Please run: ollama pull llama2');
                }
            }
            
            // Call Ollama API
            $response = Http::timeout(60)->post($ollamaUrl . '/api/generate', [
                'model' => $model,
                'prompt' => $userMessage,
                'stream' => false,
                'options' => [
                    'num_predict' => 500,
                    'temperature' => 0.7,
                    'top_p' => 0.9,
                    'stop' => ['</s>', 'Human:', 'Assistant:']
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $aiResponse = $data['response'] ?? 'Sorry, no response generated.';
                
                // Clean up response
                $aiResponse = trim($aiResponse);
                if (empty($aiResponse)) {
                    $aiResponse = "I'm not sure how to respond to that. Could you please rephrase your question?";
                }
            } else {
                $aiResponse = "Ollama error: " . $response->status() . " - " . $response->body();
            }
            
        } catch (\Exception $e) {
            $aiResponse = "Error connecting to Ollama: " . $e->getMessage() . ". Make sure Ollama is running at {$ollamaUrl}";
        }
        
        // Save to database if user is logged in
        if (Session::has('user_id')) {
            ChatHistory::create([
                'user_id' => Session::get('user_id'),
                'user_message' => $userMessage,
                'ai_response' => $aiResponse
            ]);
        }
        
        return response()->json([
            'response' => $aiResponse,
            'model_used' => $model
        ]);
    }
    
    public function clearChat(Request $request)
    {
        // Clear chat history for logged-in user
        if (Session::has('user_id')) {
            ChatHistory::where('user_id', Session::get('user_id'))->delete();
            return response()->json([
                'success' => true,
                'message' => 'Chat history cleared successfully'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'error' => 'User not logged in'
        ], 401);
    }
    
    public function getChatHistory(Request $request)
    {
        if (Session::has('user_id')) {
            $chatHistory = ChatHistory::where('user_id', Session::get('user_id'))
                ->orderBy('created_at', 'asc')
                ->get();
            
            return response()->json([
                'success' => true,
                'history' => $chatHistory
            ]);
        }
        
        return response()->json([
            'success' => false,
            'error' => 'User not logged in'
        ], 401);
    }
    
    public function deleteMessage($id)
    {
        if (Session::has('user_id')) {
            $message = ChatHistory::where('user_id', Session::get('user_id'))
                ->where('id', $id)
                ->first();
            
            if ($message) {
                $message->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Message deleted successfully'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Message not found'
            ], 404);
        }
        
        return response()->json([
            'success' => false,
            'error' => 'User not logged in'
        ], 401);
    }
    
    public function getModels(Request $request)
    {
        try {
            $settings = ChatbotSetting::all();
            $ollamaUrl = 'http://localhost:11434';
            
            foreach ($settings as $setting) {
                if ($setting->setting_key === 'ollama_api_url') {
                    $ollamaUrl = $setting->setting_value;
                }
            }
            
            $response = Http::timeout(5)->get($ollamaUrl . '/api/tags');
            
            if ($response->successful()) {
                $data = $response->json();
                $models = [];
                
                if (isset($data['models'])) {
                    foreach ($data['models'] as $model) {
                        $models[] = [
                            'name' => $model['name'],
                            'size' => $this->formatSize($model['size'] ?? 0),
                            'modified' => $model['modified_at'] ?? null
                        ];
                    }
                }
                
                return response()->json([
                    'success' => true,
                    'models' => $models
                ]);
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch models'
            ], 500);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    private function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}