<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>User Login</h1>
    <form action="index.php?action=login" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo isset($usernameCookie) ? $usernameCookie : ''; ?>" required> <!-- Pre-fill -->

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="remember">
            <input type="checkbox" id="remember" name="remember"> Remember Me
        </label>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="index.php?action=register">Register here</a></p>
</body>
</html>
