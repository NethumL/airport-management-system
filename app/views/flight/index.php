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
    <div style="margin-top: 63px;">   
        <div class="px-5 py-4 fw-bold h5 w-25" >
            <span class= "mx-5  py-2 px-3 rounded-3">Filter</span>
        </div>
    </div>
    
    <div class= "mx-5 mb-5">
        <form method="POST">  
            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="from" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">From</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="from">
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="to" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">To</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="to">
                    </div>
                </div>    
            </div>
        </form>
    </div>
    
    <div class="table-responsive">
    <table class="table w-auto" style="margin-left:180px">
        <thead>
          <tr>
            <th class="pe-5" scope="col">From <i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">To <i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">Departure <i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">Arrival <i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">Price <i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">View</th>
            <th class="pe-5" scope="col">Edit</th>
          </tr>
        </thead>
        <tbody>
          <tr > 
            <td>Colombo</td>
            <td>London</td>
            <td>2022/05/01 2 PM</td>
            <td>2022/05/05 5 PM</td>
            <td>100</td>
            <td><a class="btn" href="view/{1}" role="button"><i class="fa-solid fa-eye"></i></a></td>
            <td><a class="btn" href="edit/{1}" role="button"><i class="fa-solid fa-pen-to-square fa-1x"></i></a></td>
          </tr>
          <tr>
            <td>Colombo</td>
            <td>London</td>
            <td>2022/05/01 2 PM</td>
            <td>2022/05/05 5 PM</td>
            <td>100</td>
            <td><a class="btn" href="view/{1}" role="button"><i class="fa-solid fa-eye"></i></a></td>
            <td><a class="btn" href="edit/{1}" role="button"><i class="fa-solid fa-pen-to-square fa-1x"></i></a></td>
          </tr>
          <tr>
            <td>Colombo</td>
            <td>London</td>
            <td>2022/05/01 2 PM</td>
            <td>2022/05/05 5 PM</td>
            <td>100</td>
            <td><a class="btn" href="view/{1}" role="button"><i class="fa-solid fa-eye"></i></a></td>
            <td><a class="btn" href="edit/{1}" role="button"><i class="fa-solid fa-pen-to-square fa-1x"></i></a></td>
          </tr>
          <tr>
            <td>Colombo</td>
            <td>London</td>
            <td>2022/05/01 2 PM</td>
            <td>2022/05/05 5 PM</td>
            <td>100</td>
            <td><a class="btn" href="view/{1}" role="button"><i class="fa-solid fa-eye"></i></a></td>
            <td><a class="btn" href="edit/{1}" role="button"><i class="fa-solid fa-pen-to-square fa-1x"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class= "m-5">
        <form method="POST">  
            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="from" class="col-md-4  col-sm-5 rounded-2 col-form-label">From</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="from">
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="to" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">To</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="to">
                    </div>
                </div>    
            </div>
      
            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="departure" class="col-md-4  col-sm-5 rounded-2 col-form-label">Departure</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="departure">
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="arrival" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">Arrival</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="arrival">
                    </div>
                </div>    
            </div>

            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="cost" class="col-md-4  col-sm-5 rounded-2 col-form-label">Cost</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="cost">
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 mx-auto">
                </div>    
            </div>
              
        </form>
   </div>

    <div class="col-md-10 ">
        <button type="button" class="btn btn-success m-3 float-end">Update</button>
        <button type="button" class="btn btn-warning m-3 float-end">Clear</button>
        <button type="button" class="btn btn-danger m-3 float-end">Delete</button>
    </div>
 
</main>
</body>

</html>
