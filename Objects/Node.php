<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 24.07.18
 * Time: 17:53
 */

namespace Objects;


class Node {

    /** @var string unique id of the Node */
    private $_id;
    /** @var string IP of the Node */
    private $IP;
    /** @var string status message of the Node */
    private $status_m;
    /** @var int amount of running instances on the Node */
    private $instances;
    /** @var string CPU usage in percent */
    private $CPU;
    /** @var string RAM usage in the following format: used/available */
    private $RAM;
    /** @var string status color for interface */
    private $status_c;

    /**
     * Node constructor.
     * @param $entry array Array of a MongoDB Object
     */
    public function __construct($entry) {
        $this->_id = $entry['_id']->__toString();
        $this->IP = $entry['IP'];
        $this->status_m = $entry['Status'];
        $this->instances = $entry['Instances'];
        $this->CPU = $entry['CPU'];
        $this->RAM = $entry['RAM'];
        $this->status_c = "green";

    }

    /**
     * @return string the ID of the Node
     */
    public function getID() {
        return $this->_id;
    }

    /**
     * @return string the IP of the Node
     */
    public function getIP() {
        return $this->IP;
    }

    /**
     * @return int the status code
     */
    public function getStatusM() {
        return $this->status_m;
    }

    /**
     * @return int the amount of active instances on the Node
     */
    public function getInstances() {
        return intval($this->instances);
    }

    /**
     * @return string the CPU usage of the Server in Percent
     */
    public function getCPU() {
        return $this->CPU;
    }

    /**
     * @return string the used/available RAM
     */
    public function getRAM() {
        return $this->RAM;
    }

    /**
     * @return string the Status Color code.
     */
    public function getStatusC() {
        return $this->status_c;
    }

}