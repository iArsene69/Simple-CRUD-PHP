<?php

Class Login
{
    private $mysqli;
    
    function __construct($con)
    {
        $this->mysqli=$con;
    }

    public function loginAdmin($username, $pass)
    {
        $db = $this->mysqli->con;
        $sql = "Select * from login Where username='$username' And pass='$pass'";
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function tampilUser($id = null){
        $db = $this->mysqli->con;
        $sql="SELECT * FROM `login`";
        if ($id != null) {
            $sql .= "WHERE `id` ='$id'";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;

    }
}