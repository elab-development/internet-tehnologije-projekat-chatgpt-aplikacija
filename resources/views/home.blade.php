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
            <input type="text" id="prompt" placeholder="Enter your prompt here..." />
            <button id="submit-prompt">Submit</button>
        </div>

        <div>
            <a href="{{ route('register.form') }}">
                <button>Register</button>
            </a>
            <a href="{{ route('user.login') }}">
                <button>Login</button>
            </a>
        </div>
        
        <div id="response" style="margin-top: 20px;"></div>
    </div>

    <script>
        document.getElementById('submit-prompt').addEventListener('click', function() {
            const prompt = document.getElementById('prompt').value;

            fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ prompt: prompt })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').innerText = data.response;
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>

