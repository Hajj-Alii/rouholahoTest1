<?php
class Signal{

    private $_Name;

    public function getName()
    {
        return $this->_Name;
    }
    public function setName($name)
    {
        $this->_Name = $name;
    }

    private $_Address;

    public function getAddress()
    {
        return $this->_Address;
    }
    public function setAddress($address)
    {
        $this->_Address = $address;
    }
    function __construct($name, $address)
    {
        $this->setName($name);
        $this->setAddress($address);
    }
}