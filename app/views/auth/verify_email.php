<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Email Verified</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
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

        .btn-primary {
            width: 100%;
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
                    Email Verified
                </div>

                <div class="card-body mb-2 fw-bold border-primary">
                    <form action="forgot_password" method="post">

                        <!-- email address label and input -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <!-- Include the email address -->
                                <p>Your Email: <> has been verified!!!</p>
                            </div>
                        </div>

                        <!-- send button -->
                        <div class="row">
                            <div class="col-md-9 col-sm-9"></div>
                            <div class="col-md-3 col-sm-3">
                                <button type="submit" class="btn btn-primary fw-bold">Homepage</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>