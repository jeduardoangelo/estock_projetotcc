<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <title>Login do sistema</title>
</head>

<body>
    <form class="form-login">
        <h1>Login</h1>
        <div class="form-group txt-login">
            <label for="login">Usuário</label>
            <input type="text" name="user" id="login" placeholder="Digite o seu login" autocomplete="off">
        </div>
        <div class="form-group txt-password">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Digite sua senha">
        </div>
        <input type="submit" value="Login">
        <a href="#" id="login-forgot">Esqueci minha senha</a>
    </form>


</body>

</html>