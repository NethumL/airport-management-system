<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book</title>
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

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(<?php echo htmlspecialchars($_ENV["PLANE_WIDTH"]) ?>, 1fr);
        }
    </style>
</head>

<body>

    <?php
    showNavbar($data);
    ?>

    <main style="margin-top: 150px">
        <div class="d-flex justify-content-center" style="margin-top: 63px;">
            <div class="card col-xl-7 col-sm-12 mx-auto mb-5">
                <div class="card-header text-white bg-primary">
                    Book
                </div>
                <div class="card-body border-primary">
                    <!-- Airline -->
                    <div class="row">
                        <div class="col-md-3 col-sm-4 rounded text fw-bold ">
                            <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label">Airline:</label>
                        </div>

                        <div class="col-md-6 col-sm-6 rounded">
                            <label for="airline" class="col-md-8  col-sm-5 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($data["flight"]["airline"]) ?>
                            </label>
                        </div>

                    </div>
                    <!-- From -->
                    <div class="row">
                        <div class="col-md-3 col-sm-4 rounded text fw-bold ">
                            <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">From:</label>
                        </div>

                        <div class="col-md-6 col-sm-6 rounded">
                            <label for="from" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($data["flight"]["beginName"]) ?>
                            </label>
                        </div>
                    </div>

                    <!-- To -->
                    <div class="row">
                        <div class="col-md-3 col-sm-4 rounded text fw-bold ">
                            <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">To:</label>
                        </div>

                        <div class="col-md-6 col-sm-6 rounded">
                            <label for="to" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($data["flight"]["endName"]) ?>
                            </label>
                        </div>
                    </div>

                    <!-- Departure -->
                    <div class="row">
                        <div class="col-md-3 col-sm-4 rounded text fw-bold ">
                            <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Departure:</label>
                        </div>

                        <div class="col-md-6 col-sm-6 rounded">
                            <label for="departure" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($data["flight"]["departureDateTime"]) ?>
                            </label>
                        </div>
                    </div>

                    <!-- Arrival-->
                    <div class="row">
                        <div class="col-md-3 col-sm-4 rounded text fw-bold ">
                            <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Arrival:</label>
                        </div>

                        <div class="col-md-6 col-sm-6 rounded">
                            <label for="arrival" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">
                                <?php echo htmlspecialchars($data["flight"]["arrivalDateTime"]) ?>
                            </label>
                        </div>
                    </div>

                    <!-- Select Seats -->
                    <form action="<?php echo htmlspecialchars(BASE_URL . 'flight/book/' . $data['flight']['id']) ?>"
                          method="post" class="row">
                        <div class="col-md-3 col-sm-4 rounded text fw-bold ">
                            <label for="selectSeats" class="col-md-8  col-sm-8 me-1 rounded-2 col-form-label">Select Seats</label>
                        </div>

                        <div class="col-md-7 col-sm-7 rounded mt-2">
                            <fieldset>
                                <p class="fw-bold">Economy</p>
                                <div class="seat-grid">
                                <?php foreach ($data["seats"] as $seat) { ?>
                                    <?php if ($seat["class"] == "ECONOMY") { ?>
                                        <div class="form-check form-check-inline" style="width:10px; margin-right:30px">
                                            <input class="form-check-input" type="checkbox"
                                                   id="seat-<?php echo htmlspecialchars($seat['id']) ?>"
                                                   name="seat-<?php echo htmlspecialchars($seat['id']) ?>"
                                                   value="seat-<?php echo htmlspecialchars($seat['id']) ?>"
                                                <?php if ($seat['isBooked']) { ?>
                                                    disabled
                                                <?php } ?>
                                            >
                                            <label class="form-check-label"
                                                   for="seat-<?php echo htmlspecialchars($seat['id']) ?>">
                                                <?php echo htmlspecialchars($seat["xPosition"] . $seat["yPosition"]) ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                            </fieldset>

                            <fieldset>
                                <p class="fw-bold mt-2">Business</p>
                                <div class="seat-grid">
                                <?php foreach ($data["seats"] as $seat) { ?>
                                    <?php if ($seat["class"] == "BUSINESS") { ?>
                                        <div class="form-check form-check-inline" style="width:10px; margin-right:30px">
                                            <input class="form-check-input" type="checkbox"
                                                   id="seat-<?php echo htmlspecialchars($seat['id']) ?>"
                                                   name="seat-<?php echo htmlspecialchars($seat['id']) ?>"
                                                   value="seat-<?php echo htmlspecialchars($seat['id']) ?>"
                                                <?php if ($seat['isBooked']) { ?>
                                                    disabled
                                                <?php } ?>>
                                            <label class="form-check-label"
                                                   for="inlineCheckbox">
                                                <?php echo htmlspecialchars($seat["xPosition"] . $seat["yPosition"]) ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                </div>
                            </fieldset>
                        </div>

                        <div class="row mt-3">
                            <!-- book button -->
                            <div class="col-md-4 offset-md-7 col-sm-4 offset-sm-7">
                                <button type="submit" class="btn btn-success fw-bold">Book</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>