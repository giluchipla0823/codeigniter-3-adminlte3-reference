<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo PATH_PLUGINS; ?>fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo PATH_PLUGINS; ?>icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo PATH_DIST; ?>css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        ul.validation-errors{
            margin: 0;
            padding-left: 10px;
        }

        ul.parsley-errors-list{
            width: 100%;
            display: block;
            margin: 0;
            padding-left: 10px;
        }

        ul.parsley-errors-list li{
            color: red;
            list-style-type: none;
        }

        ul.parsley-errors-list li:before{
            content: ' * ';
        }
    </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        Registro de nuevo usuario
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <?php
            $errorsHtml = '';

            if($this->session->flashdata('error')){
                $errorsHtml .= '<li>'. $this->session->flashdata('error') .'</li>';
            }

            if(validation_errors()){
                $errorsHtml .= validation_errors("<li>", "</li>");
            }
            ?>

            <?php if($errorsHtml){ ?>
                <div class="alert alert-danger">
                    <ul class="validation-errors">
                        <?php echo $errorsHtml; ?>
                    </ul>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success">
                    <p><?php echo $this->session->flashdata('success'); ?></p>
                </div>
            <?php } ?>

            <form id="register-form" action="" method="post" novalidate data-parsley-validate>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        placeholder="Nombres"
                        value="<?php echo set_value('first_name'); ?>"
                        data-parsley-maxlength="50"
                        required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        placeholder="Apellidos"
                        value="<?php echo set_value('last_name'); ?>"
                        data-parsley-maxlength="50"
                        required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        value="<?php echo set_value('email'); ?>"
                        data-parsley-maxlength="150"
                        required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Usuario"
                        value="<?php echo set_value('username'); ?>"
                        data-parsley-minlength="6"
                        data-parsley-maxlength="50"
                        required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Contraseña"
                        data-parsley-minlength="6"
                        data-parsley-maxlength="50"
                        required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input
                        type="password"
                        name="confirm_password"
                        class="form-control"
                        placeholder="Confirmar contraseña"
                        data-parsley-equalto="#password"
                        data-parsley-equalto-message="Las contraseñas no coinciden."
                        required />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a href="<?php echo base_url('login'); ?>">Ya tengo una cuenta</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo PATH_PLUGINS; ?>jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo PATH_PLUGINS; ?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo PATH_DIST; ?>js/adminlte.min.js"></script>

<script src="<?php echo PATH_JS; ?>parsley-validator/parsley.min.js"></script>
<script src="<?php echo PATH_JS; ?>parsley-validator/i18n/es.js"></script>

<script type="text/javascript">
    $(function () {
        var config = {
            errorsContainer: function(elem) {
                var $el = elem.$element.closest('.input-group')

                if($el.length > 0){
                    return $el;
                }

                return elem;
            }
        }

        $('#register-form').parsley(config)
            .on('field:error', function(){
                this.$element.removeClass('is-valid').addClass('is-invalid');
            })
            .on('field:success', function(){
                this.$element.removeClass('is-invalid').addClass('is-valid');
            })
            .on('field:validated', function() {})
            .on('form:submit', function() {});
    });
</script>
</body>
</html>
