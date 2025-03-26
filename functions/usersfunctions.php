<?php

    include("config/dbconfig.php");

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
    if (!function_exists('getAllTheme')){
        function getAllTheme($table){
            global $con;
            $query = "SELECT * FROM $table ORDER BY created_at DESC LIMIT 3";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

    //
    if (!function_exists('getAllThemeDes')){
        function getAllThemeDes($table){
            global $con;
            $query = "SELECT * FROM $table ORDER BY created_at DESC";
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

    //
    if (!function_exists('getAllActivity')){
        function getAllActivity($table){
            global $con;
            $query = "SELECT * FROM $table ORDER BY date_activity ASC LIMIT 3";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

    // 
    if (!function_exists('getAllActivityDes')){
        function getAllActivityDes($table){
            global $con;
            $query = "SELECT * FROM $table ORDER BY date_activity ASC";
            $query_run = mysqli_query($con, $query);
            return $query_run;
        }
    }

?>