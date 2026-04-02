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
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('chatbot', compact('chatHistory'));
    }
    
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
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
                    'temperature' => 0.7
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $aiResponse = $data['response'] ?? 'Sorry, no response generated.';
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
            'response' => $aiResponse
        ]);
    }
}