<?php
if (empty($user)) {
    unset($user);
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-white ms-3" href="<?php echo htmlspecialchars(BASE_URL . 'home/index') ?>">
            <?php echo htmlspecialchars($_ENV["AIRPORT_NAME"]) ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($isLoggedIn) { ?>
                    <!--li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="<?php echo htmlspecialchars(BASE_URL . 'home/index') ?>">
                            Home
                        </a>
                    </li-->
                <?php } ?>
            </ul>
            <ul class="navbar-nav">
                <?php if ($isLoggedIn) { ?>
                    <li class="nav-item dropdown">
                        <span class="dropdown-toggle nav-link text-white" id="navbarProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($user["name"]) ?>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfileDropdown">
                            <li>
                                <a class="dropdown-item" href="">
                                    <i class="fa-solid fa-user fa-fw"></i> Account
                                </a>
                                <a class="dropdown-item" href="<?php echo htmlspecialchars(BASE_URL . 'auth/logout') ?>">
                                    <i class="fas fa-fw fa-sign-out-alt"></i> Log out
                                </a>
                            </li>
                        </ul>
                        </li-->
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="<?php echo htmlspecialchars(BASE_URL . 'auth/login') ?>">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="<?php echo htmlspecialchars(BASE_URL . 'auth/register') ?>">
                            Register
                        </a>
                    </li>
                <?php } ?>

                <!--li class="nav-item">
                    <a class="nav-link active" href="">
                        Register
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="">
                        Login
                    </a>
                </li-->
            </ul>
        </div>
    </div>
</nav>