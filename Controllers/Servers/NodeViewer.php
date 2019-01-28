<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 21.07.2018
 * Time: 21:17
 */

namespace Controllers\Servers;


use Angle\Engine\Template\Engine;
use MongoDB\Client;
use Objects\Cluster;

class NodeViewer {

    public static function listAllNodes(Engine $engine) {
        $cluster = new Cluster();
        $engine->render("views/servers.html", array(
            "title" => "All Nodes",
            "data" => $cluster->getOverview()
        ));
    }
    public static function singleNode(Engine $engine, $id) {
        $cluster = new Cluster();
        $node = $cluster->getNodeByID($id);
        $engine->render("views/node.html", array(
            "title" => "Node " . $node->getID(),
            "node" => array(
                "ID" => $node->getID(),
                "IP" => $node->getIP(),
                "status_m" => $node->getStatusM(),
                "instances" => $node->getInstances(),
                "CPU" => $node->getCPU(),
                "RAM" => $node->getRAM(),
                "status" => $node->getStatusC()
            )
        ));
    }
}