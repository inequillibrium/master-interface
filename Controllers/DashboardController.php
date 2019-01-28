<?php
namespace Controllers;

use Angle\Engine\RouterEngine\Collection;
use Angle\Engine\RouterEngine\Route;
use Angle\Engine\RouterEngine\Router;
use Angle\Engine\Template\Engine;
use Objects\Cluster;
use Tracy\Debugger;

/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 21.07.2018
 * Time: 20:33
 */

class DashboardController {

    /** @var Engine TemplateEngine */
    static $engine;
    /** @var Collection Routing Collection */
    static $collection;
    /** @var Cluster Cluster Object */
    static $cluster;

    public static function initiate() {
        Debugger::enable();
        self::$engine = new Engine();
        self::$collection = new Collection();

        self::$cluster = new Cluster();

        session_start();
        $requestURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function registerRoutes() {
        self::routes(array(
            array("/", '\Controllers\Dashboard\DashboardHandler::render', ["engine" => self::$engine], 'GET'),
            array("/nodes", '\Controllers\Servers\NodeViewer::listAllNodes', ["engine" => self::$engine], 'GET'),
            array("/node/:id", '\Controllers\Servers\NodeViewer::singleNode', ["engine" => self::$engine, "id" => "/^[a-f\d]{24}$/i"], 'GET')
        ));

        $router = new Router(self::$collection);
        $route = $router->matchCurrentRequest();
        if (!$route) {
            self::$engine->render("views/404.tmp");
        }

    }

    /**
     * @return Cluster The Cluster Object
     */
    public static function getCluster() {
        return self::$cluster;
    }

    /**
     * @param Route[] A collection of Routes to register
     */
    public static function routes($ar) {
        foreach($ar as $r) {
            self::$collection->attachRoute(new Route($r[0], array('_controller' => $r[1], 'parameters' => $r[2], 'methods' => $r[3])));
        }
    }
}