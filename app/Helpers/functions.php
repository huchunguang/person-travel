<?php
function GetWindowsUsername(){
    if (isset($_SERVER['AUTH_USER'])){
        $user=$_SERVER['AUTH_USER'];
        $user2=strstr($user, '\\');
        $user3=substr($user2, 1,strlen($user2)-1);
    }else{
        $user3='A6053995';
    }
    return $user3;
}