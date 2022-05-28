<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment</title>
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


            <div class="card col-md-5 col-sm-7 col-xs-9 mx-auto ">
                <div class="card-header text-white bg-primary">
                    Pay
                </div>
                
                <div class="card-body border-primary">
                   
                    <div class="col-md-4 col-sm-4 rounded ms-5">
                        <label for="bookingDetails" class="col-md-8  col-sm-5 rounded-2 col-form-label"><h6>Booking Details</h6></label>
                    </div>
                     
                    <form action="home/index" method="post">

                        <!-- email -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Email</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Laksi@gmail.com</label>
                            </div>
                           
                        </div>

                        <!-- Name -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Name</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Laksika T</label>
                            </div>
                            
                        </div>

                         <!-- Airline --> 
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label fw-bold ">Airline:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label">Srilankan Airlines</label>
                            </div>
                           
                        </div>


                        <!-- Class-->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="class" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Class:</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="class" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Business</label>
                            </div>
                           
                        </div>

                        <!-- Seat -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="seatNumbers" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Seat Numbers</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="seatNumbers" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">31,32</label>
                            </div>
                          
                        </div>

                        <!-- Payment Amount -->
                        <div class="row mb-3">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="payment" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Payment Amount</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="payment" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">6000</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 rounded ms-5">
                            <label for="email" class="col-md-8  col-sm-5 rounded-2 col-form-label"><h6>Card Details</h6></label>
                        </div>

                         <!-- Card holder name-->
                         <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="cardName" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Card Holder Name</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="cardName" id="cardName" required="required">
                            </div>
                           
                        </div>
                         <!-- Card number-->
                         <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="cardNumber" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Card Number</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="cardNumber" id="cardNumber" required="required">
                            </div>
                           
                        </div>

                        <!-- Expiry Date-->
                        <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="expiryDate" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Expiry Date</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="date" class="form-control" name="expiryDate" id="expiryDate" required="required">
                            </div>
                           
                        </div>

                        <!-- CNN-->
                        <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="cnn" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">CNN</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="cnn" id="cnn" required="required">
                            </div>
                           
                        </div>




                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                               <a class="btn btn-warning" href="home/index" role="button">Pay Later</a>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                
                            </div>
                            <!-- regitser button -->
                            <div class="col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-success fw-bold">Pay Now</button>
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>