<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>Forgot Password</title>
    <style>
        .login-form form {
            margin-top: 20px;
        }

        .text {
            text-align: right;
        }

        .card-body {
            background-color: white;
            border-style: solid;
            border-width: 2px;
            border-color: rgba(51, 121, 183, 255);
            font-size: 95%;
        }

        .card-header {
            background-color: #337AB7;
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
                <div class="card-header text-white">
                    Forgot Password
                </div>

                <div class="card-body mb-2 fw-bold">
                    <form action="forgot_password" method="post">

                        <div class="row">
                            <div class="col-md-9 col-sm-3 rounded text">
                                <p>You can reset your password if you forget it.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Email</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <input type="text" class="form-control" name="email" id="email" required="required">
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 col-sm-9"></div>
                            <div class="col-md-3 col-sm-3">
                                <button type="submit" class="btn btn-success fw-bold">Send</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>