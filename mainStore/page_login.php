<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="css/style_login.css">
    </head>
    <body>
        <div class="login">
            <form method="post" action="function_loginCheckAndSendEmail.php">
                <label for="login">Podaj login</label>
                <input type="text" name="login">
    
                <label for="password">Podaj hasło</label>
                <input type="password" name="password">

                <input type="submit" value="Zaloguj się">
                <input type="button" class="back_button" onclick="window.location='index.php'" value="Wróć">
            </form>
        </div>
    </body>
</html>