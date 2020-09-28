<?php
/* @var object $user */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de registro de usuario</title>
</head>
<body>
    <p>
        Gracias por registrarte en nuestra plataforma <strong><?php echo $user->first_name; ?></strong>.
    </p>
    <p>
        Ahora el siguiente paso es confirmar tu registro haciendo click
        <a href="<?php echo base_url('activate-account') . "?token=" . $user->email_verification_code; ?>">AQUÍ</a>
    </p>

</body>
</html>