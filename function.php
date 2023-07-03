<?php

function get($name = ''){
    if($_GET[$name]) return $_GET[$name];
    else return false;
}

function post($name = ''){
    if($_POST[$name]) return $_POST[$name];
    else return "0";
}

function is_login(){
    if(isset($_SESSION['login']) && $_SESSION['login'] == "1") return true;
    else return false;
}