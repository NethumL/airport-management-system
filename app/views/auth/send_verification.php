<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>Send Verification</title>
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
                    Send Verification
                </div>

                <div class="card-body mb-2 fw-bold border-primary">
                    <form action="forgot_password" method="post">

                        <!-- email address label and input -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text-end">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Email</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <input type="text" class="form-control" name="email" id="email" required="required">
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- send button -->
                        <div class="row">
                            <div class="col-md-9 col-sm-9"></div>
                            <div class="col-md-3 col-sm-3">
                                <button type="submit" class="btn btn-primary fw-bold">Send</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>