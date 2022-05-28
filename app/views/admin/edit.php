<?php require_once __DIR__ . "/../../utils.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
</head>

<body>

<?php
showNavbar($data);
?>

<main style="margin-top: 58px; margin-left: 10%">
<div class="row justify-content-center ms-5"> 
    <div style="margin-top: 63px;">   
        <div class="px-5 py-4 fw-bold h5 w-25" >
            <span class= "mx-5  py-2 px-3 rounded-3">Filter</span>
        </div>
      
    </div>
    
    <div class= "mx-5 mb-5">
        <form method="POST">  
            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="from" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">Email</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="to" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">Name</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>    
            </div>
        </form>
    </div>
    
    <div class="table-responsive">
    <table class="table w-auto" style="margin-left:25%">
        <thead>
          <tr>
            <th class="pe-5" scope="col">Email <i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">Name<i class="ms-1 fa-solid fa-sort"></i></th>
            <th class="pe-5" scope="col">userType <i class="ms-1"></i></th>
            <th class="pe-5" scope="col">Edit</th>
          </tr>
        </thead>
        <tbody>
          <tr > 
            <td>Laksi@gmail.com</td>
            <td>Laksika</td>
            <td>Employee</td>
            <td><button type="button" class="btn"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
          <tr > 
            <td>Laksi@gmail.com</td>
            <td>Laksika</td>
            <td>Employee</td>
            <td><button type="button" class="btn"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
          <tr > 
            <td>Laksi@gmail.com</td>
            <td>Laksika</td>
            <td>Employee</td>
            <td><button type="button" class="btn"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
          <tr > 
            <td>Laksi@gmail.com</td>
            <td>Laksika</td>
            <td>Employee</td>
            <td><button type="button" class="btn"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
          <tr > 
            <td>Laksi@gmail.com</td>
            <td>Laksika</td>
            <td>Employee</td>
            <td><button type="button" class="btn"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
          <tr > 
            <td>Laksi@gmail.com</td>
            <td>Laksika</td>
            <td>Employee</td>
            <td><button type="button" class="btn"><i class="fa-solid fa-pen-to-square fa-1x"></i></i></button></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="ms-5">
        <span class="ms-5"><a class="mx-5 fw-bold btn btn-success" href="admin/new" role="button">Add New Employee</a><span>
    </div>
    <div class= "m-5">
        <form method="POST">  
            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="email" class="col-md-4  col-sm-5 rounded-2 col-form-label">Email</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="name" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">Name</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>    
            </div>
      
            <div class="row fw-bold col-md-10 col-sm-10">
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="userType" class="col-md-4  col-sm-5 rounded-2 col-form-label">UserType</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="userType" value= "Employee" disabled> 
                    </div>
                </div>
                <div class="row col-md-4  col-sm-5 form-group m-3 mx-auto">
                    <label for="password" class="col-md-4  col-sm-5 me-1 rounded-2 col-form-label">Password</label>
                    <div class="col-md-6 col-sm-6 rounded">
                        <input type="text" class="form-control" id="password">
                    </div>
                </div>    
            </div>
              
        </form>
   </div>
</div>
    <div class="col-md-10 ">
        <button type="button" class="btn btn-success m-3 float-end">Update</button>
        <button type="button" class="btn btn-warning m-3 float-end">Clear</button>
        <button type="button" class="btn btn-danger m-3 float-end">Delete</button>
    </div>
 
</main>
</body>

</html>
