<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>Reset Password</title>
    <style>
        .login-form form {
            margin-top: 20px;
        }

        .card-body {
            border-style: solid;
            border-width: 2px;
            font-size: 95%;
        }

        .row {
            padding-top: 2%;
            padding-bottom: 2%;
        }

        .btn-success {
            width: 80%;
        }
    </style>
</head>

<body>

    <?php
    showNavbar($data);
    ?>

    <main style="margin-top: 10%;">
        <div class="login-form d-flex justify-content-center">
            <div class="card col-sm-5 mx-auto">
                <div class="card-header text-white bg-primary">
                    Reset Password
                </div>

                <div class="card-body mb-2 fw-bold border-primary">
                    <form action="<?php echo htmlspecialchars(BASE_URL . 'auth/reset-password/' . $data['token']) ?>" method="post">

                        <div class="row">
                            <div class="col-md-9 col-sm-3 rounded text-center">
                                <p>Enter your new password to reset your account!!</p>
                            </div>
                        </div>

                        <!-- password -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text-center">
                                <label for="password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Password</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <input type="password" class="form-control" name="password" id="password" required="required">
                            </div>

                            <div class="col-md-2 col-sm-2"></div>
                        </div>

                        <!-- confirm password -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text-center">
                                <label for="confirm_password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Confirm Password</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="required">
                            </div>

                            <div class="col-md-2 col-sm-2"></div>
                        </div>

                        <!-- reset button -->
                        <div class="row">
                            <div class="col-md-9 col-sm-9"></div>
                            <div class="col-md-3 col-sm-3">
                                <button type="submit" class="btn btn-success fw-bold">Reset</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>