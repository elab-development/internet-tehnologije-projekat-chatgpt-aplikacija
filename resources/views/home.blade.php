<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Home</title>
</head>
<body>
    <div>
        <h1>Welcome to Chatbot</h1>

        <div>
            <a href="{{ route('register.form') }}">
                <button>Register</button>
            </a>
            <a href="{{ route('user.login') }}">
                <button>Login</button>
            </a>
        </div>

        <h1>Chatbot</h1>
    
        <form id="chatForm" action="{{ route('chat') }}" method="POST">
            @csrf
            <label for="prompt">Enter your prompt:</label>
            <input type="text" id="prompt" name="prompt" required>
            
            <button type="submit">Submit</button>
        </form>

        <!-- Response display container -->
        <div id="responseContainer">
            <h3>AI Response:</h3>
            <textarea id="responseMessage" rows="10" cols="50" readonly>{{ $responseContent ?? '' }}</textarea>
        </div>
        </div>
</body>
</html>

