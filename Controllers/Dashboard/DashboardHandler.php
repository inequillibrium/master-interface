<?php
namespace Controllers\Dashboard;

use Angle\Engine\Template\Engine;
use Controllers\DashboardController;

/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 21.07.2018
 * Time: 20:36
 */

class DashboardHandler {

    public static function render(Engine $engine) {

        $engine->render("views/index.html", array(
            "title" => "Dashboard",
            "instances" => DashboardController::getCluster()->getTotalInstances(),
            "s_ok" => DashboardController::getCluster()->getAmountByStatus(200),
            "s_internal" => DashboardController::getCluster()->getAmountByStatus(500),
            "s_bad_gateway" => DashboardController::getCluster()->getAmountByStatus(502),
            "s_service_unavailable" => DashboardController::getCluster()->getAmountByStatus(504)
        ));
    }

}