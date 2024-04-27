<?php

class Connect
{
    protected $host = "localhost";
    protected $user = "root";
    protected $pass = "";
    protected $db = "nm_cendidate_check";

    public $con;

    function __construct()
    {
        $this->db_conect();
    }

    function db_conect()
    {
        $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->con->connect_error) {
            echo "Connection Failed: " . $this->con->connect_error;
        }
        
    }
}
