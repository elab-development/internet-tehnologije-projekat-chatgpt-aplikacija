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
    @if(isset($conversations))
        @foreach($conversations as $conversation)
            <div>
                <h3>Title: <input type="text" name="title" value="{{ $conversation->title }}" readonly></h3>
                <ul>
                    @foreach($conversation->messages as $message)
                        <li>{{ $message->content }}</li>
                    @endforeach
                </ul>
                <form method="POST" action="{{ route('chat.edit', $conversation->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="text" name="title" value="{{ $conversation->title }}" required>
                    <button type="submit">Edit</button>
                </form>

                <form method="POST" action="{{ route('chat.delete', $conversation->id) }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this conversation?');">Delete</button>
                </form>
            </div>
        @endforeach
    @endif


    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
