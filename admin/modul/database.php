<?php

class Database
{
    private $host;
    private $user;
    private $pass;
    private $dbase;
    public $con;

    function __construct($host, $user, $pass, $dbase)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbase = $dbase;

        $this->con = new mysqli($this->host, $this->user, $this->pass, $this->dbase) or die(mysqli_error());

        if ($this->con === false) {
            return false;
        }else {
            return true;
        }
    }
}
