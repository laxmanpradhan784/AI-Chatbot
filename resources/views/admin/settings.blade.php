@extends('layouts.app')

@section('title', 'Chatbot Settings')

@section('content')
<h1>Chatbot Settings</h1>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="{{ route('admin.update-settings') }}">
            @csrf
            <div class="mb-3">
                <label>Ollama API URL</label>
                <input type="url" name="ollama_api_url" class="form-control" value="{{ $settings->where('setting_key', 'ollama_api_url')->first()->setting_value ?? 'http://localhost:11434' }}" required>
            </div>
            <div class="mb-3">
                <label>Ollama Model</label>
                <input type="text" name="ollama_model" class="form-control" value="{{ $settings->where('setting_key', 'ollama_model')->first()->setting_value ?? 'llama2' }}" required>
                <small class="text-muted">Options: llama2, mistral, codellama, etc.</small>
            </div>
            <div class="mb-3">
                <label>Max Tokens</label>
                <input type="number" name="max_tokens" class="form-control" value="{{ $settings->where('setting_key', 'max_tokens')->first()->setting_value ?? '500' }}" min="1" max="2000" required>
            </div>
            <div class="mb-3">
                <label>Temperature (0-2)</label>
                <input type="number" step="0.1" name="temperature" class="form-control" value="{{ $settings->where('setting_key', 'temperature')->first()->setting_value ?? '0.7' }}" min="0" max="2" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
@endsection