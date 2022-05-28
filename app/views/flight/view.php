<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>View Flight Details</title>
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
            <div class="card col-ls-5 col-md-5 col-sm-9 col-xs-12 mx-auto">
                <div class="card-header text-white bg-primary">
                    From Colombo to Jaffna
                </div>

                <div class="card-body border-primary mb-2">
                    <form action="book" method="post">


                        <!-- Airline --> 
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="airline" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Airline:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="airline" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Srilankan Airlines</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- From -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">From:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Colombo</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- To -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">To:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Jaffna</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- Departure -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Departure:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">24/05/2022 5:00</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- Arrival-->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Arrival:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">25/05/2022 5:00</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- Economy Class -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="economyClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Economy Class Price:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="economyClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">3000</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                         <!-- Business Class -->
                         <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="businessClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Business Class Price:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="businessClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">5000</label>
                            </div>
                            <div class="col-md-3 col-sm-3"></div>
                        </div>

                        <!-- send button -->
                        <div class="row">
                            <div class="col-md-9 col-sm-9"></div>
                            <div class="col-md-3 col-sm-3">
                                <button type="submit" class="btn btn-primary fw-bold">Book Now</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>