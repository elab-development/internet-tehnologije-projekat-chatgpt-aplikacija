<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Form</title>
</head>
<body>
    <h1>Main Form</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif


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

    <h2>Previous Conversations</h2>


    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
