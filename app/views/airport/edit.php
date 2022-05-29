<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Airport</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
</head>

<body>

<?php
showNavbar($data);
?>

<main style="margin-top: 58px; margin-left: 10%">
    <div style="margin-top: 70px">
        <?php display_flash_message("airport/edit"); ?>
    </div>
    <div id="alert-container">
    </div>
<div class="row justify-content-center ms-5">
    <div style="margin-top: 63px;">   
        <div class="px-5 py-4 fw-bold h5 w-25" >
            <span class= "mx-5  py-2 px-3 rounded-3">Filter</span>
        </div>
      
    </div>
    
    <div class="mx-5 mb-5">
        <form method="POST" id="filter-form">
            <div class="row">
                <label for="filterName" class="col-md-1 offset-md-2 col-sm-5 rounded-2 col-form-label">Name</label>
                <div class="col-md-2 col-sm-6 rounded">
                    <input type="text" class="form-control" name="name" id="filterName">
                </div>

                <div class="col-md-2 offset-md-1">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="table-responsive">
    <table class="table w-auto" id="airport-table" style="margin-left:35%">
        <thead>
          <tr>
            <th class="pe-5" scope="col">Airport Name<i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">Edit</th>
          </tr>
        </thead>
        <tbody>
        <?php if (isset($data["airport"])) { ?>
          <tr data-id="<?php echo htmlspecialchars($data['airport']['id']) ?>">
            <td><?php echo htmlspecialchars($data["airport"]["name"]) ?></td>
            <td><button type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

    <div class="m-5">
        <form method="POST" id="update-form">
            <div class="row col-md-10 col-sm-10">
              <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                  <label for="name" class="col-md-4  col-sm-5 ms-5 me-1 rounded-2 col-form-label">Name</label>
                  <div class="col-md-6 col-sm-6 rounded">
                      <input type="text" class="form-control" id="name" name="name">
                  </div>
              </div>    
              <div class="row form-group mx-auto mt-3">
                  <div class="col-md-10">
                    <button id="update-button" type="submit" class="btn btn-success mx-3 mt-2 float-end">Update</button>
                    <button id="clear-button" type="reset" class="btn btn-warning mx-3 mt-2 float-end">Clear</button>
                    <button id="delete-button" type="button" class="btn btn-danger mx-3 mt-2 float-end">Delete</button>
                </div>
              </div>
            </div>
        </form>
   </div>
</div>

</main>

<script src="<?php echo htmlspecialchars(BASE_URL . 'public/js/airport-edit.js') ?>"></script>

<?php if (isset($data["airport"])) { ?>
    <script>
        const row = table.querySelector("tbody tr");
        if (row)
            editAirport(row);
    </script>
<?php } ?>

</body>

</html>
