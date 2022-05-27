<!-- <?php require_once __DIR__ . '/../../utils.php' ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">
    <style>
        .login-form form {
            background: white;
            /* box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); */
            /* padding: 30px; */
        }

        .text {
            text-align: right;
        }

        .row {
            padding-top: 3%;
            padding-bottom: 2%;
        }

        .btn {
            width: 100%;
        }

        .btn-primary {
            background-color: #337AB7;
        }

        .btn-success {
            background-color: #5db85c;
        }

        .card-body {
            border-style: solid;
            border-width: 2px;
            border-color: rgba(51, 121, 183, 255);
            font-size: 95%;
        }
    </style>
</head>

<body>


    <main style="margin-top: 150px">
        <div class="login-form d-flex justify-content-center" style="margin-top: 63px;">


            <div class="card col-sm-5 mx-auto ">
                <div class="card-header text-white" style="background-color:#337AB7;">
                    Log In
                </div>
                <div class="card-body mb-2 fw-bold">
                    <form action="login" method="post">



                        <!-- email -->
                        <div class="row">
                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="email" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Email</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="text" class="form-control" name="email" id="email" required="required">
                            </div>
                            <div class="col-md-2 col-sm-2"></div>
                        </div>

                        <!-- password -->
                        <div class="row">

                            <div class="col-md-3 col-sm-3 rounded text">
                                <label for="password" class="col-md-8  col-sm-5 me-1 rounded-2 col-form-label">Password</label>
                            </div>

                            <div class="col-md-7 col-sm-7 rounded">
                                <input type="password" class="form-control" name="password" id="password" required="required">
                            </div>
                            <div class="col-md-2 col-sm-2"></div>
                        </div>

                        <!-- forgot password link -->
                        <div class="row">
                            <div class="col-md-7 col-sm-7"></div>
                            <div class="col-md-4 col-sm-4">
                                <a href="#" class="link-dark">Forgot Password?</a>
                            </div>
                            <div class="col-md-1 col-sm-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-primary fw-bold">Register new account</button>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-success fw-bold">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

</html>