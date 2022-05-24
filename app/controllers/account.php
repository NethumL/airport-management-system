<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";

class account extends Controller {

    public function view() {
        session_start();
        $this->checkAuth("account/view", function () {
            if (!isset($_SESSION["user"])) {
                redirectRelative("auth/login");
            }
            return $this->getViewData();
        });
    }

}
