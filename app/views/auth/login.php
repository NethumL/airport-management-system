<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <style>
        .text {
            text-align: right;
        }

        .row {
            padding-top: 3%;
            padding-bottom: 2%;
        }

        .btn {
            width: 100%;
        }

        .card-body {
            border-style: solid;
            border-width: 2px;
            border-color: rgba(51, 121, 183, 255);
            font-size: 95%;
        }
    </style>
</head>

<body>

    <?php
    showNavbar($data, false);
    ?>

    <main style="margin-top: 150px">
        <div class="login-form d-flex justify-content-center" style="margin-top: 63px;">


            <div class="card col-sm-5 mx-auto ">
                <div class="card-header text-white bg-primary">
                    Log In
                </div>
                <div class="card-body mb-2 fw-bold">
                    <form action="login" method="post">

                        <!-- error message -->
                        <?php display_flash_message("auth/login") ?>

                        <!-- email -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Email</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="email" id="email" required="required">
                            </div>
                            <div class="col-md-2 col-sm-2"></div>
                        </div>

                        <!-- password -->
                        <div class="row">

                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Password</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="password" class="form-control" name="password" id="password" required="required">
                            </div>
                            <div class="col-md-2 col-sm-2"></div>
                        </div>

                        <!-- forgot password link -->
                        <div class="row">
                            <div class="col-md-7 col-sm-7"></div>
                            <div class="col-md-4 col-sm-4">
                                <a class="link-dark" href="<?php echo htmlspecialchars(BASE_URL . 'auth/forgot_password') ?>">
                                    Forgot Password?
                                </a>
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <a class="btn btn-primary fw-bold" href="<?php echo htmlspecialchars(BASE_URL . 'auth/register') ?>">
                                    Register new account
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-success fw-bold">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>