<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 24.07.18
 * Time: 17:53
 */

namespace Objects;

use MongoDB\Client;
use MongoDB\Collection;

class Cluster {

    /**
     * @var array Array of Nodes
     */
    private $nodes = array();

    /**
     * Cluster constructor.
     */
    public function __construct() {
        /** @var TYPE_NAME $mongo */
        $mongo = new Client();
        $collection = $mongo->balancer->nodes;

        /** @var Collection $collection */
        $result = $collection->find();

        foreach ($result as $entry) {
            $this->nodes[$entry['_id']->__toString()] = new Node($entry);
        }
    }

    /**
     * @return array returns an array of all the nodes on the cluster
     */
    public function getNodes() {
        return $this->nodes;
    }

    public function addNode(Node $node) {
        $this->nodes[$node->getID()] = $node;
    }

    /**
     * @param $id string ID that is associated with the server
     * @return Node|false returns the Node Object if found, otherwise false
     */
    public function getNodeByID($id) {
        return $this->nodes[$id];
    }

    /**
     * @param $ip string IP that is associated with the server
     * @return Node|false returns the Node Object if found, otherwise false
     */
    public function getNodeByIP($ip) {
        foreach ($this->nodes as $node) {
            if ($node->getIP() == $ip) return $node;
        }
        return false;
    }

    /**
     * @return array returns the array needed to render the server overview.
     */
    public function getOverview() {
        $data = array();
        /** @var Node $node */
        foreach ($this->nodes as $node) {
            $data[] = array("ID" => $node->getID(), "IP" => $node->getIP(), "status_m" => $node->getStatusM(), "instances" => $node->getInstances(), "CPU" => $node->getCPU(), "RAM" => $node->getRAM(), "status" => $node->getStatusC());
        }
        return $data;
    }

    /**
     * @return int the amount of active instances on the cluster
     */
    public function getTotalInstances() {
        $i = 0;
        /** @var Node $node */
        foreach ($this->nodes as $node) {
            $i += $node->getInstances();
        }
        return $i;
    }

    /**
     * @param $code int desired Status Code
     * @return int the amount of Nodes having that status code at the moment
     */
    public function getAmountByStatus($code) {
        $i = 0;
        /** @var Node $node */
        foreach ($this->nodes as $node) {
            $i += $node->getStatusM() == $code ? 1 : 0;
        }
        return $i;
    }
}