<?php
// Save as: C:\xampp\htdocs\ai-chatbot\public\test-direct.php
// Access: http://localhost/ai-chatbot/public/test-direct.php

$message = $_POST['message'] ?? 'Hello, how are you?';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Direct Ollama Test</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 800px; margin: 0 auto; }
        .response { background: #f0f0f0; padding: 15px; margin-top: 20px; border-radius: 5px; }
        textarea { width: 100%; height: 100px; margin: 10px 0; }
        button { padding: 10px 20px; background: blue; color: white; border: none; cursor: pointer; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Direct Ollama Connection Test</h1>
    
    <form method="POST">
        <label>Message:</label>
        <textarea name="message"><?php echo htmlspecialchars($message); ?></textarea>
        <button type="submit">Send to Ollama</button>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ollamaUrl = 'http://localhost:11434/api/generate';
        $data = [
            'model' => 'llama2',
            'prompt' => $message,
            'stream' => false,
            'options' => [
                'num_predict' => 500,
                'temperature' => 0.7
            ]
        ];
        
        $ch = curl_init($ollamaUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            echo "<div class='response error'>";
            echo "<h3>CURL Error:</h3>";
            echo "<p>$error</p>";
            echo "</div>";
        } else {
            echo "<div class='response'>";
            echo "<h3>Response from Ollama (HTTP $httpCode):</h3>";
            
            $decoded = json_decode($response, true);
            if ($decoded && isset($decoded['response'])) {
                echo "<p class='success'>✓ Success!</p>";
                echo "<strong>AI Response:</strong><br>";
                echo "<p>" . nl2br(htmlspecialchars($decoded['response'])) . "</p>";
            } else {
                echo "<pre>" . htmlspecialchars($response) . "</pre>";
            }
            echo "</div>";
        }
    }
    ?>
    
    <h3>Check Available Models:</h3>
    <?php
    $ch = curl_init('http://localhost:11434/api/tags');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $models = json_decode($response, true);
    if (isset($models['models'])) {
        echo "<ul>";
        foreach ($models['models'] as $model) {
            echo "<li>" . htmlspecialchars($model['name']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p class='error'>No models found. Run: ollama pull llama2</p>";
    }
    ?>
</body>
</html>