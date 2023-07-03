<?php
session_start();
include 'dbclass.php';
include 'function.php';

class app{
    private $url;
    private $title = 'Заголовок страницы';
    private $description = 'Краткое описание страницы';
    private $login = false;
    function __construct($url = '') {
        $this->url = $url;
        $db = new DBClass();
        switch ($url){
            case 'exit':
                unset($_SESSION["login"]);
                header('Location: /login');
            break;
            case 'admin':  
                if(is_login()){
                    print "функционал админки";
                    $this->title = "Страница администратора";
                    $this->description = "Страница администратора";
                    $this->admin();
                }else{
                    header('Location: /login');
                }
            break;
            case 'enter':
                   print_r($_POST); 
                   $login = post('login');
                   $password = post('password');
                   //print_r($user =  $db->sqlOne("SELECT * FROM user LIMIT 1"));
                   if($user["2"] === md5($password)){
                    $_SESSION['login'] = 1;
                    header('Location: /admin');
                   }else{
                    print "переброс на форму";
                   }
            break;
            case 'add_element':
                if(is_login()){

                    $name = post('name');
                    $description = post('description');
                    $parent = post('par');

                    $sql = "INSERT INTO `object` (`name`, `description`, `parent`) VALUES ('".$name."', '".$description."', '".$parent."')";

                    $uobject =  $db->insert($sql);

                    header('Location: /admin');
                }else{
                    header('Location: /login');
                }
            break;
            case 'login':
                $this->title = "Вход в часть администратора";
                $this->description = "Вход в часть администратора";
                $this->login();

            break;
            case 'page':
                $this->title = "Обычная страница";
                $this->description = "Краткое описание обычной страницы";
                echo $this->page();
            break;
            default:
            echo "такой страницы не существует";
        }
    }

    function login(){
        $content = $this->_head();
        $content .=  $this->_login_form();
        $content .=  $this->_footer();
        return $content;
    }
    function page(){
        $content = $this->_head();
        return $content;
    }
    function admin(){
        $content = $this->_head();
        $content .=  $this->_admin();
        $content .=  $this->_footer();
        return $content;
    }
    private function _head(){
        $title = $this->title;
        $description = $this->description;
        return include($_SERVER['DOCUMENT_ROOT'].'/view/head.php'); 
    }
    private function _footer(){
        $head = include($_SERVER['DOCUMENT_ROOT'].'/view/footer.php'); 
    }
    private function _login_form(){
        return  include($_SERVER['DOCUMENT_ROOT'].'/view/login_form.php'); 
    }
    private function _admin(){
        return  include($_SERVER['DOCUMENT_ROOT'].'/view/admin.php'); 
    }
}