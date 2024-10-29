

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
</head>
<body>
    <h2>Registracija</h2>

    @if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <label for="name">Ime:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <label for="password_confirmation">Potvrdi lozinku:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br>

        <button type="submit">Registruj se</button>
    </form>
</body>
</html>
