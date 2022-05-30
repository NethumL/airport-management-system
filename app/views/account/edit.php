<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>Edit Account Details</title>
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

        #save-button {
            width: 80%;
        }
    </style>
</head>

<body>
    <?php
    showNavbar($data);
    ?>

    <main style="margin-top: 10rem;">
        <div class="login-form d-flex justify-content-center">
            <div class="card col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="card-header text-white bg-primary">
                    Edit Account Details
                </div>

                <div class="card-body mb-2 fw-bold">
                    <form action="<?php echo htmlspecialchars(BASE_URL . 'account/edit') ?>" method="post">
                        <!-- email -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">Email :</label>
                            </div>

                            <div class="col-md-9 col-sm-9 rounded">
                                <label for="email" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">
                                    <?php echo htmlspecialchars($_SESSION['user']['email']) ?>
                                </label>
                            </div>
                        </div>

                        <!-- user Type -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">User Type :</label>
                            </div>

                            <div class="col-md-9 col-sm-9 rounded">
                                <label for="email" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">
                                    <?php echo htmlspecialchars($_SESSION['user']['userType']) ?>
                                </label>
                            </div>
                        </div>


                        <!-- Name -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="name" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">Name :</label>
                            </div>

                            <div class="col-md-9 col-sm-9 rounded">
                                <input type="text" class="form-control" name="name" id="name" required="required"
                                       value="<?php echo htmlspecialchars($_SESSION['user']['name']) ?>">
                            </div>
                        </div>

                        <!-- send button -->
                        <div class="row mt-3">
                            <div class="col-md-8 offset-md-1 col-sm-8 offset-sm-1">
                                <a class="btn btn-warning fw-bold"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'auth/forgot-password') ?>">
                                    Forgot password
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <button type="submit" class="btn btn-success fw-bold" id="save-button">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>