<?php
function url_get($name = ''){
    if(isset($_GET[$name])) {
        return htmlspecialchars(trim(strip_tags($_GET[$name])));
    } else {
        return false;
    } 
}

function url_post($name = ''):string
{
    if($_POST[$name]) return htmlspecialchars(trim(strip_tags($_POST[$name])));
    else return "0";
}

function is_login(){
    if(isset($_SESSION['login']) && $_SESSION['login'] == "1") return true;
    else return false;
}

