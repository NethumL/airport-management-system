<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <style>
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
        <div class="d-flex justify-content-center" style="margin-top: 63px;">
            <div class="card col-md-5 col-sm-7 col-xs-9 mx-auto ">
                <div class="card-header text-white bg-primary">
                    Pay
                </div>
                
                <div class="card-body border-primary">
                   
                    <div class="col-md-4 col-sm-4 rounded ms-5">
                        <label for="bookingDetails" class="col-md-8  col-sm-5 rounded-2 col-form-label"><h6>Booking Details</h6></label>
                    </div>
                     
                    <form action="<?php echo htmlspecialchars(BASE_URL . 'flight/pay/' . $data['booking']['id']) ?>" method="post">
                        <!-- email -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold ">Email</label>
                            </div>

                            <div class="col-md-8 col-sm-8 rounded">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                                    <?php echo htmlspecialchars($data["user"]["email"]) ?>
                                </label>
                            </div>
                           
                        </div>

                        <!-- Name -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="name" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">Name</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                                    <?php echo htmlspecialchars($data["user"]["name"]) ?>
                                </label>
                            </div>
                            
                        </div>

                         <!-- Airline --> 
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="airline" class="col-md-8 col-sm-5 rounded-2 col-form-label fw-bold">Airline</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label">
                                    <?php echo htmlspecialchars($data["flight"]["airline"]) ?>
                                </label>
                            </div>
                           
                        </div>

                        <!-- Seat -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="seatNumbers" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">Seat Numbers</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="seatNumbers" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label">
                                    <?php
                                    $seatNames = array_map(function ($seat) {
                                        return $seat['xPosition'] . $seat['yPosition'];
                                    }, $data["seats"]);
                                    echo htmlspecialchars(join(", ", $seatNames));
                                    ?>
                                </label>
                            </div>
                          
                        </div>

                        <!-- Payment Amount -->
                        <div class="row mb-3">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="payment" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">Payment Amount</label>
                            </div>

                            <div class="col-md-6 col-sm-6 rounded">
                                <label for="payment" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label">
                                    Rs. <?php echo htmlspecialchars($data["amount"]) ?>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 rounded ms-5">
                            <label for="email" class="col-md-8 col-sm-5 rounded-2 col-form-label"><h6>Card Details</h6></label>
                        </div>

                         <!-- Card holder name-->
                         <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="cardName" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">Card Holder Name</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="cardName" id="cardName" required="required">
                            </div>
                           
                        </div>
                         <!-- Card number-->
                         <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="creditCardNumber" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">
                                    Card Number
                                </label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="creditCardNumber" id="creditCardNumber" required="required">
                            </div>
                        </div>

                        <!-- Expiry Date-->
                        <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="expiryDate" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">Expiry Date</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="date" class="form-control" name="expiryDate" id="expiryDate" required="required">
                            </div>
                           
                        </div>

                        <!-- CVV -->
                        <div class="row mb-5">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="cvv" class="col-md-8 col-sm-5 me-1 rounded-2 col-form-label fw-bold">CVV</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="cvv" id="cvv" required="required">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <a class="btn btn-warning"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'home/index') ?>" role="button">
                                    Pay Later
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                
                            </div>
                            <!-- pay button -->
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