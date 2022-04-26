<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo htmlspecialchars(BASE_URL . 'home/index') ?>">
            Airport Management System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($isLoggedIn) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="<?php echo htmlspecialchars(BASE_URL . 'home/index') ?>">
                            Home
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav">
                <?php if ($isLoggedIn) { ?>
                    <li class="nav-item dropdown">
                        <span class="text-white dropdown-toggle" id="navbarProfileDropdown" role="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($user["name"]) ?>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfileDropdown">
                            <li>
                                <a class="dropdown-item"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'auth/logout') ?>">
                                    <i class="fas fa-fw fa-sign-out-alt"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo htmlspecialchars(BASE_URL . 'auth/login') ?>">
                            Login
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>