<?php

class Kelas
{
    private $mysqli;
    function __construct($con)
    {
        $this->mysqli = $con;

    }
    function tampilKelas($id = null)
    {
        $db = $this->mysqli->con;
        $sql = "SELECT * FROM `class`";
        if($id != null){
            $sql .= "WHERE `id` ='$id'";
        }
        $query = $db->query($sql) or die($db->error);
		return $query;
    }

    function tambahKelas($nama, $deskripsi, $foto)
    {
        $db = $this->mysqli->con;
        $sql = "Insert into class values ('', '$nama','$deskripsi', '$foto')";
        $query = $db->query($sql) or die($db->error);
    }

    function ubahKelas($sql)
    {
        $db = $this->mysqli->con;
        $query = $db->query($sql) or die($db->error);
    }

    function hapusKelas($sql)
    {
        $db = $this->mysqli->con;
        $query = $db->query($sql) or die($db->error);
    }



}


