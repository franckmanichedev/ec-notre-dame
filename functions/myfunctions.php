<?php

    include("../config/dbconfig.php");

    //
    if (!function_exists('getAll')){
        function getAll($table){
            global $con;
            $query = "SELECT * FROM $table";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

    //
    if (!function_exists('getThemeById')){
        function getThemeById($table, $id){
            global $con;
            $query = $con->prepare("SELECT * FROM `$table` WHERE id_themes = ?");
            $query->bind_param("i", $id);
            $query->execute();
            $result = $query->get_result();
            return $result;
        }
    }

    // Recuperer tout les administrateur qui on pour role = 1
    if (!function_exists('getAllSpirit')){
        function getAllSpirit($table){
            global $con;
            $query = "SELECT * FROM $table WHERE id = 1";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }
?>