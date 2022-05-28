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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (isset($user) && $user["userType"] == "MANAGER") { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarAdminDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarAdminDropdown">
                            <li>
                                <a class="dropdown-item" href="<?php echo htmlspecialchars(BASE_URL . 'admin/new') ?>">
                                    Add new
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo htmlspecialchars(BASE_URL . 'admin/edit') ?>">Edit</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarFlightDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Flights
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarFlightDropdown">
                        <?php if (isset($user) && in_array($user["userType"], ["MANAGER", "EMPLOYEE"])) { ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo htmlspecialchars(BASE_URL . 'flight/new') ?>">
                                    Add new
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a class="dropdown-item" href="<?php echo htmlspecialchars(BASE_URL . 'flight/index') ?>">
                                View all
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (isset($user) && in_array($user["userType"], ["MANAGER", "EMPLOYEE"])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarAirportDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Airports
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarAirportDropdown">
                            <li>
                                <a class="dropdown-item"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'airport/new') ?>">Add new</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'airport/edit') ?>">Edit</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($user)) { ?>
                    <li class="nav-item dropdown">
                        <span class="dropdown-toggle nav-link text-white" id="navbarProfileDropdown" role="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($user["name"]) ?>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfileDropdown">
                            <li>
                                <a class="dropdown-item"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'account/view') ?>">
                                    <i class="fa-solid fa-user fa-fw"></i> Account
                                </a>
                                <a class="dropdown-item"
                                   href="<?php echo htmlspecialchars(BASE_URL . 'auth/logout') ?>">
                                    <i class="fas fa-fw fa-sign-out-alt"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active text-white"
                           href="<?php echo htmlspecialchars(BASE_URL . 'auth/login') ?>">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white"
                           href="<?php echo htmlspecialchars(BASE_URL . 'auth/register') ?>">
                            Register
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>