<?php require_once __DIR__ . '/../../utils.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Airport</title>
    <?php include __DIR__ . "/../templates/head.php" ?>
    <style>
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

    <main style="margin-top: 13%">
        <div class="d-flex">
            <div class="mx-auto">
                <?php display_flash_message("airport/new"); ?>
            </div>
        </div>
        <div class="d-flex justify-content-center " style="margin-top: 63px;">


            <div class="card col-sm-5 mx-auto ">
                <div class="card-header text-white bg-primary">
                    Add Airport
                </div>
                <div class="card-body fw-bold border-primary">
                    <form action="<?php echo htmlspecialchars(BASE_URL . 'airport/new') ?>" method="post">
                        <!-- name -->
                        <div class="row">
                            <div class="col-md-4 col-sm-4 rounded text-end">
                                <label for="name" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Name</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="name" id="name" required="required">
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>
                         
                        <div class="row">
                            <div class="col-md-7 col-sm-7"></div>

                            <!-- register button -->
                            <div class="col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-success fw-bold">Add</button>
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>