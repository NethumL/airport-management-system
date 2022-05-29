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
                <label for="filterEmail" class="col-md-1 offset-md-2 col-sm-5 rounded-2 col-form-label">Email</label>
                <div class="col-md-2 col-sm-6 rounded">
                    <input type="text" class="form-control" name="email" id="filterEmail">
                </div>
                <label for="filterName" class="col-md-1 col-sm-5 rounded-2 col-form-label">Name</label>
                <div class="col-md-2 col-sm-6 rounded">
                    <input type="text" class="form-control" name="name" id="filterName">
                </div>
                <div class="col-md-2 offset-md-1">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive d-flex">
        <table class="table w-auto mx-auto" id="user-table" style="margin-left: 180px">
            <thead>
            <tr>
                <th scope="col">Email <span><i class="fas fa-solid fa-sort"></i></span></th>
                <th scope="col">Name <span><i class="fas fa-solid fa-sort"></i></span></th>
                <th scope="col">User type <span><i class="fas fa-solid fa-sort"></i></span></th>
                <th scope="col">Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($data["showUser"])) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($data["showUser"]["email"]) ?></td>
                    <td><?php echo htmlspecialchars($data["showUser"]["name"]) ?></td>
                    <td><?php echo htmlspecialchars($data["showUser"]["userType"]) ?></td>
                    <td>
                        <button class="btn btn-warning edit-button"><i class="fa-solid fa-pen-to-square fa-1x"></i></button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="m-5">
        <form method="POST" class="container" id="update-form">
            <div class="row fw-bold">
                <div class="row">
                    <label for="email" class="col-sm-1 offset-sm-2 rounded-2 col-form-label">Email</label>
                    <div class="col-sm-3 rounded">
                        <input type="text" class="form-control" name="email" id="email" readonly>
                    </div>
                    <label for="name" class="col-sm-1 offset-sm-1 me-1 rounded-2 col-form-label">Name</label>
                    <div class="col-sm-3 rounded">
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>

            <div class="row fw-bold mt-5">
                <div class="row">
                    <label for="userType" class="col-sm-1 offset-sm-2 rounded-2 col-form-label">Type</label>
                    <div class="col-sm-3 rounded">
                        <input type="text" class="form-control" name="userType" id="userType" readonly>
                    </div>
                </div>
            </div>

            <div class="col-md-10 mt-5">
                <button id="update-button" type="submit" class="btn btn-success m-3 float-end">Update</button>
                <button id="clear-button" type="button" class="btn btn-warning m-3 float-end">Clear</button>
                <button id="delete-button" type="button" class="btn btn-danger m-3 float-end">Delete</button>
            </div>
        </form>
    </div>
</main>


<script src="<?php echo htmlspecialchars(BASE_URL . 'public/js/admin-edit.js') ?>"></script>

<?php if (isset($data["showUser"])) { ?>
    <script>
        const row = table.querySelector("tbody tr");
        if (row)
            editUser(row);
    </script>
<?php } ?>

</body>

</html>
