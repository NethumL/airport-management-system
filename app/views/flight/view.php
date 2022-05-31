<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include __DIR__ . "/../templates/head.php" ?>
    <title>View Flight Details</title>
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
    <div class="d-flex justify-content-center">
        <div class="card col-ls-5 col-md-5 col-sm-9 col-xs-12 mx-auto">
            <div class="card-header text-white bg-primary">
                <?php echo htmlspecialchars("From " . $data["flight"]["beginName"] . " to " . $data["flight"]["endName"]) ?>
            </div>

            <div class="card-body border-primary mb-2">
                <!-- Airline -->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="airline"
                               class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Airline:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="airline" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["airline"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- From -->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">From:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["beginName"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- To -->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">To:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["endName"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- Departure -->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Departure:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["departureDateTime"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- Arrival-->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="arrival"
                               class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Arrival:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["arrivalDateTime"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- Economy Class -->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="economyClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Economy
                            Class Price:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="economyClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["economyClassPrice"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- Business Class -->
                <div class="row">
                    <div class="col-md-4 col-sm-4 rounded text-end">
                        <label for="businessClassPrice"
                               class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label fw-bold">Business Class
                            Price:</label>
                    </div>

                    <div class="col-md-6 col-sm-6 rounded">
                        <label for="businessClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                            <?php echo htmlspecialchars($data["flight"]["businessClassPrice"]) ?>
                        </label>
                    </div>
                    <div class="col-md-3 col-sm-3"></div>
                </div>

                <!-- book link -->
                <div class="row">
                    <div class="col-md-9 col-sm-9"></div>
                    <div class="col-md-3 col-sm-3">
                        <a class="btn btn-primary fw-bold"
                           href="<?php echo htmlspecialchars(BASE_URL . 'flight/book/' . $data['flight']['id']) ?>">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
