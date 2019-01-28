<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 21.07.2018
 * Time: 20:32
 */

use Controllers\DashboardController;

require("vendor/autoload.php");

define("APP_URL", "/TS3AB-BalancerDashboard/");

DashboardController::initiate();
DashboardController::registerRoutes();