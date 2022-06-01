<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flight</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
</head>

<body>

<?php
showNavbar($data);
?>

<main style="margin-top: 58px">
    <div style="margin-top: 70px;">
        <?php display_flash_message("flight/index"); ?>
    </div>
    <div id="alert-container">
    </div>

    <div class="container">
        <div class="px-5 py-3 fw-bold h5 w-25" >
            <span class= "mx-5 py-2 px-3 rounded-3">Filter</span>
        </div>
    </div>

    <div class="mb-5" style="margin-left: 5rem;">
        <form method="POST" id="filter-form">
            <div class="row">
                <div class="col-md-2 offset-md-2 col-sm-5">
                    <div class="row">
                        <label for="filterFrom" class="col-md-4 col-form-label">From</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="from" id="filterFrom">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <label for="filterTo" class="col-md-4 col-sm-5 col-form-label">To</label>
                        <div class="col-md-8 col-sm-6">
                            <input type="text" class="form-control" name="to" id="filterTo">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="row">
                        <label for="filterStatus" class="col-md-4 col-form-label">Status</label>
                        <div class="col-md-8">
                            <select name="status" id="filterStatus" class="form-select">
                                <option selected disabled value="">Select status</option>
                                <option value="SCHEDULED">Scheduled</option>
                                <option value="IN_PROGRESS">In progress</option>
                                <option value="CANCELLED">Cancelled</option>
                                <option value="ARRIVED">Arrived</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="table-responsive d-flex">
    <table class="table w-auto mx-auto" id="flight-table" style="margin-left:180px">
        <thead>
          <tr>
            <th scope="col">Airline <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">From <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">To <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">Departure <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">Arrival <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">Economy <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">Business <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">Status <span><i class="fas fa-solid fa-sort"></i></span></th>
            <th scope="col">View</th>
            <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"])) { ?>
              <th scope="col">Edit</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
        <?php if (isset($data["flight"])) { ?>
            <tr data-id="<?php echo htmlspecialchars($data['flight']['id']) ?>">
                <td><?php echo htmlspecialchars($data["flight"]["airline"]) ?></td>
                <td data-id="<?php echo htmlspecialchars($data['flight']['begin']) ?>">
                    <?php echo htmlspecialchars($data["flight"]["beginName"]) ?>
                </td>
                <td data-id="<?php echo htmlspecialchars($data['flight']['end']) ?>">
                    <?php echo htmlspecialchars($data["flight"]["endName"]) ?>
                </td>
                <td><?php echo htmlspecialchars($data["flight"]["departureDateTime"]) ?></td>
                <td><?php echo htmlspecialchars($data["flight"]["arrivalDateTime"]) ?></td>
                <td><?php echo htmlspecialchars($data["flight"]["economyClassPrice"]) ?></td>
                <td><?php echo htmlspecialchars($data["flight"]["businessClassPrice"]) ?></td>
                <td><?php echo htmlspecialchars($data["flight"]["status"]) ?></td>
                <td>
                    <a class="btn btn-info" href="<?php echo htmlspecialchars(BASE_URL . 'flight/view/' . $data['flight']['id']) ?>">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
                <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"])) { ?>
                <td><button class="btn btn-warning edit-button"><i class="fa-solid fa-pen-to-square fa-1x"></i></button>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

    <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"])) { ?>
    <div class="m-5">
        <form method="POST" class="container" id="update-form">
            <div class="row fw-bold">
                <div class="row">
                    <label for="airline" class="col-sm-1 offset-sm-2 rounded-2 col-form-label">Airline</label>
                    <div class="col-sm-3 rounded">
                        <select class="form-select" name="airline" id="airline">
                            <option selected disabled>Select Airline</option>
                            <option value="Sri Lankan Airlines">Sri Lankan Airlines</option>
                            <option value="Cinnamon Air">Cinnamon Air</option>
                            <option value="Cathay Pacific">Cathay Pacific</option>
                        </select>
                    </div>
                    <label for="status" class="col-sm-1 offset-sm-1 rounded-2 col-form-label">Status</label>
                    <div class="col-sm-3 rounded">
                        <select name="status" id="status" class="form-select">
                            <option selected disabled>Select status</option>
                            <option value="SCHEDULED">Scheduled</option>
                            <option value="IN_PROGRESS">In progress</option>
                            <option value="CANCELLED">Cancelled</option>
                            <option value="ARRIVED">Arrived</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row fw-bold mt-5">
                <div class="row">
                    <label for="begin" class="col-sm-1 offset-sm-2 rounded-2 col-form-label">From</label>
                    <div class="col-sm-3 rounded">
                        <select class="form-select" aria-label=".form-select" name="begin" id="begin">
                            <option selected disabled>Select From</option>
                            <?php foreach($data["airports"] as $airport) { ?>
                                <option value="<?php echo htmlspecialchars($airport['id']) ?>">
                                    <?php echo htmlspecialchars($airport["name"]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <label for="end" class="col-sm-1 offset-sm-1 rounded-2 col-form-label">To</label>
                    <div class="col-sm-3 rounded">
                        <select class="form-select" aria-label=".form-select" name="end" id="end">
                            <option selected disabled>Select To</option>
                            <?php foreach($data["airports"] as $airport) { ?>
                                <option value="<?php echo htmlspecialchars($airport['id']) ?>">
                                    <?php echo htmlspecialchars($airport["name"]) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row fw-bold mt-5">
                <div class="row">
                    <label for="departureDateTime" class="col-sm-1 offset-sm-2 rounded-2 col-form-label">Departure</label>
                    <div class="col-sm-3 rounded">
                        <input type="datetime-local" class="form-control" name="departureDateTime" id="departureDateTime">
                    </div>
                    <label for="arrivalDateTime" class="col-sm-1 offset-sm-1 me-1 rounded-2 col-form-label">Arrival</label>
                    <div class="col-sm-3 rounded">
                        <input type="datetime-local" class="form-control" name="arrivalDateTime" id="arrivalDateTime">
                    </div>
                </div>
            </div>


            <div class="row fw-bold mt-5">
                <div class="row">
                    <label for="economyClassPrice" class="col-sm-1 offset-sm-2 rounded-2 col-form-label">Economy class price</label>
                    <div class="col-sm-3 rounded">
                        <input type="number" step="0.01" min="0" class="form-control" name="economyClassPrice" id="economyClassPrice">
                    </div>
                    <label for="businessClassPrice" class="col-sm-1 offset-sm-1 me-1 rounded-2 col-form-label">Business class price</label>
                    <div class="col-sm-3 rounded">
                        <input type="number" step="0.01" min="0" class="form-control" name="businessClassPrice" id="businessClassPrice">
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <button id="update-button" type="submit" class="btn btn-success m-3 float-end">Update</button>
                <button id="clear-button" type="button" class="btn btn-warning m-3 float-end">Clear</button>
                <button id="delete-button" type="button" class="btn btn-danger m-3 float-end">Delete</button>
            </div>
        </form>
   </div>
    <?php } ?>

</main>

<script>
    let canEdit;
    <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) { ?>
    canEdit = true;
    <?php } else { ?>
    canEdit = false;
    <?php } ?>
</script>

<script src="<?php echo htmlspecialchars(BASE_URL . 'public/js/flight-index.js') ?>"></script>

<?php if (isset($data["flight"])) { ?>
    <script>
        if (canEdit) {
            const row = table.querySelector("tbody tr");
            if (row)
                editFlight(row);
        }
    </script>
<?php } ?>

</body>

</html>
