<?php


class pageclass{


    function __construct($title = '',$description = '') {
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