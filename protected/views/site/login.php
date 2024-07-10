<!DOCTYPE html>
<html lang="en">

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="top: 30%; border-radius: 50px; position: relative;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('/MARS/images/logov2.png'); background-size: 80%; background-position: center center; background-repeat: no-repeat; padding-right: 15px; padding-left: 15px; border-right: 5px solid red;">
                            </div>
                            <div class="col-lg-6">
                                <br>
                                <br>
                                <br>
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'login-form',
                                            'enableClientValidation' => true,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => true,
                                            ),
                                        )); ?>
                                        <br>
                                        <br>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-fw fa-user"></i>
                                                </span>
                                            </div>
                                            <?php echo $form->textField($model, 'username', array('class' => "form-control form-control-user", 'placeholder' => 'ENTER USERNAME')); ?>
                                        </div>
                                        <?php echo $form->error($model, 'username'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-fw fa-lock"></i>
                                                </span>
                                            </div>
                                            <?php echo $form->passwordField($model, 'password', array('class' => "form-control form-control-user", 'placeholder' => 'ENTER PASSWORD')); ?>
                                        </div>
                                        <?php echo $form->error($model, 'password'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <?php echo $form->checkBox($model, 'rememberMe', array('class' => "custom-control-input")); ?>
                                            <?php echo $form->label($model, 'rememberMe', array('class' => "custom-control-label")); ?>
                                            <?php echo $form->error($model, 'rememberMe'); ?>
                                        </div>
                                    </div>
                                        <?php echo CHtml::submitButton('Login', array('class' => "btn btn-primary btn-user btn-block")); ?>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main 'Login' text positioned on top left after the red divider -->
                    <h1 class="h4 text-gray-900 mb-4" style="font-weight: bold; position: absolute; top: 10px; left: calc(50% + 10px);">Login</h1>
                    <h2 class="h4 text-gray-900 mb-4" style="font-size: 15px; position: absolute; top: 37px; left: calc(50% + 15px);">Please login to continue</h2>
                </div>

            </div>

        </div>
    </div>
</body>

</html>





    </div>
	<?php $this->endWidget(); ?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>