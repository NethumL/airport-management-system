<?php

require_once __DIR__ . "/../utils.php";
require_once __DIR__ . "/../models/UserManager.php";

class home extends Controller
{
    public function index()
    {
        $this->checkAuth("home/index", function () {
            return $this->getViewData();
        });
    }
}
