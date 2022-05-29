<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Flight</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <style>
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

    <main style="margin-top: 80px">
        <div class="d-flex">
            <div class="mx-auto">
                <?php display_flash_message("flight/new"); ?>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 30px;">
            <div class="card col-lg-6 col-md-6 col-sm-8 mx-auto ">
                <div class="card-header text-white bg-primary">
                    Add Flight
                </div>
                <div class="card-body mb-2 fw-bold border-primary">
                    <form action="<?php echo htmlspecialchars(BASE_URL . 'flight/new') ?>" method="post">
                        <!-- Airline -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="airline" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Airline</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm" name="airline" id="airline">
                                    <option selected>Select Airline</option>
                                    <option value="Sri Lankan Airlines">Sri Lankan Airlines</option>
                                    <option value="Cinnamon Air">Cinnamon Air</option>
                                    <option value="Cathay Pacific">Cathay Pacific</option>
                                </select>
                            </div>
                        </div>

                        <!-- From -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="begin" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">From</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm" name="begin" id="begin">
                                    <option selected>Select From</option>
                                    <?php foreach($data["airports"] as $airport) { ?>
                                        <option value="<?php echo htmlspecialchars($airport['id']) ?>">
                                            <?php echo htmlspecialchars($airport["name"]) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                         <!-- To -->
                         <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="end" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">To</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm" name="end" id="end">
                                    <option selected>Select To</option>
                                    <?php foreach($data["airports"] as $airport) { ?>
                                        <option value="<?php echo htmlspecialchars($airport['id']) ?>">
                                            <?php echo htmlspecialchars($airport["name"]) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="departureDateTime" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Departure</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="datetime-local" class="form-control" name="departureDateTime" id="departureDateTime" required="required">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="arrivalDateTime" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Arrival</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="datetime-local" class="form-control" name="arrivalDateTime" id="arrivalDateTime" required="required">
                            </div>
                        </div>
                        <!-- economyClassPrice -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="economyClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Economy Class Price</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="number" class="form-control" name="economyClassPrice" id="economyClassPrice" required="required">
                            </div>
                        </div>

                         <!-- businessClassPrice-->
                         <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text">
                                <label for="businessClassPrice" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Business Class Price</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                               <input type="number" class="form-control" name="businessClassPrice" id="businessClassPrice" required="required">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-7 col-sm-7"></div>

                            <div class="col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-success fw-bold">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>