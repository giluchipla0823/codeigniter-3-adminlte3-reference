<?php
/* @var object $model */

$urlRecoverPassword = base_url('recover-password') . "?token=" . $model->token;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
</head>
<body>
    <p>
        El enlace para restablecer la contraseña es:
        <a href="<?php echo $urlRecoverPassword; ?>"><?php echo $urlRecoverPassword; ?></a>
    </p>
</body>
</html>