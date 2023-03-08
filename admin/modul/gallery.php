<?php

class Gallery
{
    private $mysqli;

    function __construct($con)
    {
        $this->mysqli = $con;
    }

    function tampilGallery($id = null)
    {
        $db = $this->mysqli->con;
        $sql = "SELECT * FROM `gallery`";
        if ($id != null){
            $sql .= "WHERE `id`='$id'";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    function tambahGallery($nama, $gambar)
    {
        $db = $this->mysqli->con;
        $sql = "INSERT INTO `gallery` VALUES('', '$nama', '$gambar')";
        $query = $db->query($sql) or die($db->error);
    }

    function ubahGallery($sql)
    {
        $db = $this->mysqli->con;
        $query = $db->query($sql) or die($db->error);
    }

    function hapusGallery($sql)
    {
        $db = $this->mysqli->con;
        $query = $db->query($sql) or die($db->error);
    }
}