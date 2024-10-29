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


    
    <form action="" method="POST">
        @csrf
        <label for="prompt">Enter your prompt:</label>
        <textarea id="prompt" name="prompt" required></textarea>
        <br>
        <button type="submit">Submit Prompt</button>
    </form>

    <h2>Previous Conversations</h2>


    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
