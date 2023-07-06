<?php
session_start();
include_once 'dbclass.php';
include_once 'function.php';
include_once 'treeclass.php';
include_once 'adminclass.php';
include_once 'pageclass.php';

class app{
    private $url;
    private $title = 'Заголовок страницы';
    private $description = 'Краткое описание страницы';
    private $login = false;
    private $page;
    function __construct($url = '') {

        $this->url = url_get($url);

        if($this->url === 'page'){

            echo $this->page();

        }elseif($this->url == 'exit'
                or 
                $this->url == 'admin' 
                or 
                $this->url == 'enter' 
                or 
                $this->url =='add_element' 
                or 
                $this->url == 'login' 
                or 
                $this->url == 'update' 
                or 
                $this->url == 'delete'){
                
            $this->title = "Страница администратора";
            $this->description = "Краткое описание страницы администратора";
            $this->_head();
            $this->page = new adminclass($this->url);
            $this->_footer();
        }
        else{
            echo "такой страницы не существует";
        }
    }

    function page(){

        $this->title = "Обычная страница";
        $this->description = "Краткое описание обычной страницы";
        $this->page = new pageclass($this->title, $this->description);
        $content = $this->_head();
        $content .= $this->page->create();
        $content .=  $this->_footer();
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

}