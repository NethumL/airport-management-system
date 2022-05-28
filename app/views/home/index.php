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
            <a type="button" class="btn btn-info text-white" href="<?php echo htmlspecialchars(BASE_URL . 'flight/index') ?>">
                View all flights
            </a>
            <?php if (!isset($data["user"])) { ?>
                <a type="button" class="btn btn-info text-white" href="<?php echo htmlspecialchars(BASE_URL . 'auth/register') ?>">
                    Register new account
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="card col-sm-5 mx-auto mt-5">
        <div class="card-header text-white bg-primary">
          <?php if (isset($data["user"]) && in_array($data["user"]["userType"], ["MANAGER", "EMPLOYEE"], true)) { ?>
              New flights
              <a class="btn btn-info text-white float-end" href="<?php echo htmlspecialchars(BASE_URL . 'flight/index') ?>">
                  View all
              </a>
          <?php } else { ?>
              Booked flights
          <?php }  ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table w-auto">
                    <thead>
                      <tr>
                        <th class="pe-5" scope="col">From </th>
                        <th class="pe-5" scope="col">To </th>
                        <th class="pe-5" scope="col">Departure </th>
                        <th class="pe-5" scope="col">Arrival</th>
                        <th class="pe-5" scope="col">Price </th>
                        <th class="pe-5" scope="col">View</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr > 
                        <td>Colombo</td>
                        <td>London</td>
                        <td>2022/05/01 2 PM</td>
                        <td>2022/05/05 5 PM</td>
                        <td>100</td>
                        <td><button type="button" class="btn"><i class="fa-solid fa-eye"></i></button></td>
                      
                      </tr>
                      <tr>
                        <td>Colombo</td>
                        <td>London</td>
                        <td>2022/05/01 2 PM</td>
                        <td>2022/05/05 5 PM</td>
                        <td>100</td>
                        <td><button type="button" class="btn"><i class="fa-solid fa-eye"></i></button></td>
                       
                      </tr>
                      <tr>
                        <td>Colombo</td>
                        <td>London</td>
                        <td>2022/05/01 2 PM</td>
                        <td>2022/05/05 5 PM</td>
                        <td>100</td>
                        <td><button type="button" class="btn"><i class="fa-solid fa-eye"></i></button></td>
                        
                      </tr>
                      <tr>
                        <td>Colombo</td>
                        <td>London</td>
                        <td>2022/05/01 2 PM</td>
                        <td>2022/05/05 5 PM</td>
                        <td>100</td>
                        <td><button type="button" class="btn"><i class="fa-solid fa-eye"></i></button></td>
                       
                      </tr>
                    </tbody>
                  </table>
                </div>   
        </div>
    </div>

</main>
</body>

</html>
