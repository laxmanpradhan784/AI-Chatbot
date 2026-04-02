<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ChatHistory;
use App\Models\ChatbotSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!Session::has('user_id') || Session::get('user_type') !== 'admin') {
            return redirect()->route('login');
        }
        return null;
    }
    
    public function dashboard()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        
        $totalUsers = User::where('user_type', 'user')->count();
        $totalChats = ChatHistory::count();
        $recentChats = ChatHistory::with('user')->latest()->limit(10)->get();
        
        return view('admin.dashboard', compact('totalUsers', 'totalChats', 'recentChats'));
    }
    
    public function viewUsers()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        
        $users = User::where('user_type', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }
    
    public function viewChatHistory()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        
        $chatHistory = ChatHistory::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.chat-history', compact('chatHistory'));
    }
    
    public function showSettings()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        
        $settings = ChatbotSetting::all();
        return view('admin.settings', compact('settings'));
    }
    
    public function updateSettings(Request $request)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        
        $request->validate([
            'ollama_model' => 'required|string',
            'ollama_api_url' => 'required|url',
            'max_tokens' => 'required|integer|min:1|max:2000',
            'temperature' => 'required|numeric|min:0|max:2'
        ]);
        
        ChatbotSetting::set('ollama_model', $request->ollama_model);
        ChatbotSetting::set('ollama_api_url', $request->ollama_api_url);
        ChatbotSetting::set('max_tokens', $request->max_tokens);
        ChatbotSetting::set('temperature', $request->temperature);
        
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
    
    public function deleteUser($id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;
        
        $user = User::find($id);
        if ($user && $user->user_type !== 'admin') {
            ChatHistory::where('user_id', $id)->delete();
            $user->delete();
        }
        
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}