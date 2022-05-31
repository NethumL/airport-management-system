<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>View Account Details</title>
    <style>
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

    <main style="margin-top: 10rem;">
        <div class="d-flex justify-content-center">
            <div class="card col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto">
                <div class="card-header text-white bg-primary">
                    View Account Details
                </div>

                <div class="card-body mb-2 fw-bold border-primary">
                    <!-- email -->
                    <div class="row">
                        <div class="col-md-3 col-sm-3 rounded text-end">
                            <label for="email" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">Email :</label>
                        </div>

                        <div class="col-md-9 col-sm-9 rounded">
                            <label for="email" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($_SESSION['user']['email']) ?>
                            </label>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="row">
                        <div class="col-md-3 col-sm-3 rounded text-end">
                            <label for="name" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">Name :</label>
                        </div>

                        <div class="col-md-9 col-sm-9 rounded">
                            <label for="name" class="col-md-12 col-sm-12 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($_SESSION['user']['name']) ?>
                            </label>
                        </div>
                    </div>

                    <!-- user Type -->
                    <div class="row">
                        <div class="col-md-3 col-sm-3 rounded text-end">
                            <label for="email" class="col-md-12 col-sm-5 me-1 rounded-2 col-form-label">User Type :</label>
                        </div>

                        <div class="col-md-9 col-sm-9 rounded">
                            <label for="email" class="col-md-12 col-sm-5 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($_SESSION['user']['userType']) ?>
                            </label>
                        </div>
                    </div>

                    <!-- edit button -->
                    <div class="row mt-3">
                        <div class="col-md-8 offset-md-1 col-sm-8 offset-sm-1">
                            <a class="btn btn-warning fw-bold"
                               href="<?php echo htmlspecialchars(BASE_URL . 'auth/forgot-password') ?>">
                                Forgot password
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <a class="btn btn-success fw-bold"
                               href="<?php echo htmlspecialchars(BASE_URL . 'account/edit') ?>">Edit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>

</html>
