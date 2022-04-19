<?php
    function getPwdSecutiry($pwd){
        return md5($pwd);
    }
    function getGET($key){
        $value ="";
        if(isset($_GET[$key])){
            $value=$_GET[$key];
        }
        $value = htmlspecialchars(strip_tags($value));
        return $value;
    }
    function getPOST($key){
        $value ="";
        if(isset($_POST[$key])){
            $value=$_POST[$key];
        }
        $value = htmlspecialchars(strip_tags($value));
        return $value;
    }
?>