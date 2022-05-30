<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>View Account Details</title>
    <style>
        .login-form form {
            margin-top: 20px;
        }

        .text {
            text-align: right;
        }

        .card-body {
            border-style: solid;
            border-width: 2px;
            border-color: rgba(51, 121, 183, 255);
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
                <div class="card-header text-white">
                    View Account Details
                </div>

                <div class="card-body mb-2 fw-bold">
                    <form action="forgot_password" method="post">


                        <!-- email -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Email :</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label"><?php echo $_SESSION['user']['email'] ?></label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- Name -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Name :</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label"><?php echo $_SESSION['user']['name'] ?></label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- user Type -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">User Type :</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label"><?php echo $_SESSION['user']['userType'] ?></label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- password -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Password :</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Password Here??</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- edit button -->
                        <div class="row">
                            <div class="col-md-9 col-sm-9"></div>
                            <div class="col-md-3 col-sm-3">
                                <a class="btn btn-success fw-bold" href="<?php echo htmlspecialchars(BASE_URL . 'account/edit') ?>">Edit</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>