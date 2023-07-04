<?php


class pageclass{
    private $url;
    private $db;

    function __construct($title = '',$description = '') {
        $this->db = new DBClass();

    }    

    public function create(){

        print $this->page();
    }
    private function page(){
        $tree = new treeclass();
        $list = $tree->create('list');
        return include($_SERVER['DOCUMENT_ROOT'].'/view/page.php'); 
    }


}