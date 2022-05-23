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
<div style="margin-top: 150px;">   
        <div class="m-5 fw-bold text-white fs-1 text-center" >
            <span class= "p-5" style="background-color:#337AB7;">Foo Airport</span>
        </div>
    </div>
    <div class=" pt-5"></div>

    <div class="card col-sm-4 mx-auto ">
        <div class="card-header text-white" style="background-color:#337AB7;">
          Quick Links
        </div>
        <div class="card-body mb-2">
                <button type="button" class="col-lg-2 btn text-white ms-5 mt-1 col-md-8 col-sm-8" style="background-color:#5AC0DE;">Search</button>
                <button type="button" class="col-lg-4 btn text-white ms-4 me-4 mt-1 col-md-10 col-sm-10" style="background-color:#5AC0DE;">Register new account</button>
                <button type="button" class="col-lg-3 btn text-white mt-1 col-md-12 col-sm-12" style="background-color:#5AC0DE;">Edit schedules</button>
        </div>
    </div>

    <div class=" pt-3"></div>

    <div class="card col-sm-5 mx-auto mt-5">
        <div class="card-header text-white " style="background-color:#337AB7;">
          New flights
          <button type="button" class="col-md-3 col-sm-6 btn text-white ms-5 me-4 float-end" style="background-color:#5AC0DE;">View all</button>
        </div>
        <div class="card-body mb-2">
            <div class="table-responsive mx-5">
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
