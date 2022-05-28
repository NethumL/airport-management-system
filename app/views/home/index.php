<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
</head>

<body>

<?php
showNavbar($data);
?>

<main style="margin-top: 58px">
    <h1 class="text-center" style="margin-top: 80px;"><?php echo htmlspecialchars($_ENV["AIRPORT_NAME"]) ?></h1>
    <div class="card col-sm-4 mx-auto mt-5">
        <div class="card-header text-white bg-primary">
            Quick Links
        </div>
        <div class="card-body mb-2 d-flex justify-content-evenly">
            <a type="button" class="btn btn-info text-white"
               href="<?php echo htmlspecialchars(BASE_URL . 'flight/index') ?>">
                View all flights
            </a>
            <?php if (!isset($data["user"])) { ?>
                <a type="button" class="btn btn-info text-white"
                   href="<?php echo htmlspecialchars(BASE_URL . 'auth/register') ?>">
                    Register new account
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="card col-sm-9 mx-auto mt-5">
        <div class="card-header text-white bg-primary">
            <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) { ?>
                Upcoming flights
                <a class="btn btn-info text-white float-end"
                   href="<?php echo htmlspecialchars(BASE_URL . 'flight/index') ?>">
                    View all
                </a>
            <?php } else { ?>
                Booked flights
            <?php } ?>
        </div>
        <div class="card-body">
            <div class="table-responsive d-flex">
                <table class="table mx-auto">
                    <thead>
                    <tr>
                        <th class="pe-5" scope="col">Airline</th>
                        <th class="pe-5" scope="col">From</th>
                        <th class="pe-5" scope="col">To</th>
                        <th class="pe-5" scope="col">Departure</th>
                        <th class="pe-5" scope="col">Arrival</th>
                        <th class="pe-5" scope="col">Economy Class Price</th>
                        <th class="pe-5" scope="col">Business Class Price</th>
                        <th class="pe-5" scope="col">View</th>
                        <?php if (isset($data["user"]) && $data["user"]["userType"] == "CUSTOMER") { ?>
                            <th class="pe-5" scope="col">Pay</th>
                            <th class="pe-5" scope="col">Seats</th>
                        <?php } else { ?>
                            <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) { ?>
                                <th class="pe-5" scope="col">Edit</th>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($data["user"]) && $data["user"]["userType"] == "CUSTOMER") { ?>
                        <?php foreach ($data["bookings"] as $booking) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($booking["flight"]["airline"]) ?></td>
                                <td><?php echo htmlspecialchars($booking["flight"]["beginName"]) ?></td>
                                <td><?php echo htmlspecialchars($booking["flight"]["endName"]) ?></td>
                                <td><?php echo htmlspecialchars($booking["flight"]["departureDateTime"]) ?></td>
                                <td><?php echo htmlspecialchars($booking["flight"]["arrivalDateTime"]) ?></td>
                                <td><?php echo htmlspecialchars($booking["flight"]["economyClassPrice"]) ?></td>
                                <td><?php echo htmlspecialchars($booking["flight"]["businessClassPrice"]) ?></td>
                                <td>
                                    <a class="btn btn-info"
                                       href="<?php echo htmlspecialchars(BASE_URL . 'flight/view/' . $booking['flight']['id']) ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <?php if ($booking["isPaid"]) { ?>
                                        Paid
                                    <?php } else { ?>
                                        <a class="btn btn-success"
                                           href="<?php echo htmlspecialchars(BASE_URL . 'flight/pay/' . $booking['id']) ?>">
                                            <i class="fa-solid fa-credit-card"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php
                                    $seatNames = array_map(function ($seat) {
                                        return $seat['xPosition'] . $seat['yPosition'];
                                    }, $booking["seats"]);
                                    echo htmlspecialchars(join(", ", $seatNames));
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <?php foreach ($data["flights"] as $flight) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($flight["airline"]) ?></td>
                                <td><?php echo htmlspecialchars($flight["beginName"]) ?></td>
                                <td><?php echo htmlspecialchars($flight["endName"]) ?></td>
                                <td><?php echo htmlspecialchars($flight["departureDateTime"]) ?></td>
                                <td><?php echo htmlspecialchars($flight["arrivalDateTime"]) ?></td>
                                <td><?php echo htmlspecialchars($flight["economyClassPrice"]) ?></td>
                                <td><?php echo htmlspecialchars($flight["businessClassPrice"]) ?></td>
                                <td>
                                    <a class="btn btn-info"
                                       href="<?php echo htmlspecialchars(BASE_URL . 'flight/view/' . $flight['id']) ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) { ?>
                                    <td>
                                        <a class="btn btn-warning"
                                           href="<?php echo htmlspecialchars(BASE_URL . 'flight/edit/' . $flight['id']) ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
</body>

</html>
