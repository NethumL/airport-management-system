<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <style>
        .login-form form {
            background: white;
            /* box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); */
            /* padding: 30px; */
        }

        .text {
            text-align: right;
        }

        .row {
            padding-top: 2%;
            padding-bottom: 2%;
        }

        .btn {
            width: 100%;
        }

        .btn-primary {
            background-color: #337AB7;
        }

        .btn-success{
            background-color:  rgba(93,184,92,255);
        }

        .card-body {
            border-style: solid;
            border-width: 2px;
            border-color: rgba(51, 121, 183, 255);
            font-size: 90%;
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
                <div class="card-header text-white" style="background-color:#337AB7;">
                    Register
                </div>
                <div class="card-body mb-2 fw-bold">
                    <form action="login" method="post">

                        <!-- error message -->
                        <?php display_flash_message("auth/register") ?>

                        <!-- email -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Email</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="email" id="email" required="required">
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>

                        <!-- name -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Name</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="name" id="name" required="required">
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>

                        <!-- password -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Password</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="password" class="form-control" name="password" id="password" required="required">
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>

                        <!-- confirm password -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="confirm_password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Confirm Password</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="required">
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 col-sm-7"></div>

                            <!-- regitser button -->
                            <div class="col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-success fw-bold">Register</button>
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>