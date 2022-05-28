<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <style>
        .login-form form {
            background: white;
        }

        .text {
            text-align: right;
        }


        .btn {
            width: 100%;
        }

        .card-body {
            border-style: solid;
            border-width: 2px;
            font-size: 90%;
        }
    </style>
</head>

<body>

    <?php
    showNavbar($data);
    ?>

    <main style="margin-top: 150px">
        <div class="login-form d-flex justify-content-center" style="margin-top: 63px;">


            <div class="card col-md-5 col-sm-7 mx-auto ">
                <div class="card-header text-white bg-primary">
                    Book
                </div>
                <div class="card-body border-primary">
                    <form action="pay" method="post">
                         <!-- Airline --> 
                         <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text fw-bold ">
                                <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label">Airline:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label">Srilankan Airlines</label>
                            </div>
                           
                        </div>
                        <!-- From -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text fw-bold ">
                                <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">From:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Colombo</label>
                            </div>
                        </div>

                        <!-- To -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text fw-bold ">
                                <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">To:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Jaffna</label>
                            </div>
                        
                        </div>

                        <!-- Departure -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text fw-bold ">
                                <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Departure:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">24/05/2022 5:00</label>
                            </div>
                        </div>

                        <!-- Arrival-->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text fw-bold ">
                                <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Arrival:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">25/05/2022 5:00</label>
                            </div>
                        </div>
                        <!-- Select Seats -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text fw-bold ">
                                <label for="selectSeats" class="col-md-8  col-sm-8 me-1 rounded-2 col-form-label">Select Seats</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded mt-2">
                             
                                <fieldset >
                                    <p class="fw-bold">Economy</p>
                                    <?php
                                    for ($x = 1; $x <= 30; $x++) {
                                    ?>
                                    <div class="form-check form-check-inline" style="width:10px; margin-right:30px">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox" value="option">
                                        <label class="form-check-label" for="inlineCheckbox"><?=$x;?></label>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                </fieldset>
                               
                                <fieldset>
                                    <p class="fw-bold mt-2">Business</p>
                                    <?php
                                    for ($x = 31; $x <= 60; $x++) {
                                    ?>
                                    <div class="form-check form-check-inline" style="width:10px; margin-right:30px">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox" value="option">
                                        <label class="form-check-label" for="inlineCheckbox"><?=$x;?></label>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                </fieldset>

                            </div>
                           
                            
                        </div>

                        <div class="row">
                            <div class="col-md-7 col-sm-7"></div>

                            <!-- book button -->
                            <div class="col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-success fw-bold">Book</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>