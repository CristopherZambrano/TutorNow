<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <h1>Inicie sesión</h1>
    <form method="POST">

        <div>
            <label for="name">Name: </label>
            <input id="name" name="name" required>
        </div>

        <div>
            <label for="lastName">Last name: </label>
            <input id="lastName" name="lastName" required>
        </div>

        <div>
            <label for="user">User:</label>
            <input id="user" name="user" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Iniciar Sesión</button>
        </div>
    </form>
</body>
</html>