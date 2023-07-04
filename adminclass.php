<?php



class adminclass{
    private $url;
    function __construct($url = '') {

        $this->url = $url;
        $db = new DBClass();
        $this->db = $db ;
        if(is_login()){
                switch ($url){
                    case 'admin':  
                            return $this->admin();
                    break;
                    case 'update':
                        $id = url_get('id');
                        print_r($_POST);
                        $name = url_post('name');
                        $description = url_post('description');
                        $sql = " UPDATE `object` SET name='".$name."', description='".$description."' WHERE id=".$id;
                        $db->q($sql);
                        header('Location: /admin');
                    break;
                    case 'delete':
                        $id = url_get('id');
                        $sqld = "DELETE FROM `object` WHERE id=".$id;
                        $this->db->q($sqld); 
                        $this->_delete($id);
                        header('Location: /admin');
                    break;
                    case 'add_element':
                        
                            $name = url_post('name');
                            $description = url_post('description');
                            $parent = url_post('parent');
                            $sql = "INSERT INTO `object` (`name`, `description`, `parent`) VALUES ('".$name."', '".$description."', '".$parent."')";
                            $uobject =  $db->insert($sql);
                            header('Location: /admin');

                    break;
                }
            }else if($this->url === "login" ){
                return $this->_login_form();
            }else if($this->url === "enter" ){

                $login = url_post('login');
                $password = url_post('password');
                $user =  $db->sqlOne("SELECT * FROM user LIMIT 1");

                if($user["2"] === md5($password)){
                    $_SESSION['login'] = 1;
                    header('Location: /admin');
                }else{
                    header('Location: /login?error=1');
                }
            }else if($this->url === "exit" ){
                unset($_SESSION["login"]);
                header('Location: /login');
            }

    }
    public function admin(){
        $content .=  $this->_admin();
        return $content;
    }
    private function _login_form(){
        return  include($_SERVER['DOCUMENT_ROOT'].'/view/login_form.php'); 
    }
    private function _admin(){
        $tree = new treeclass();
        $select = $tree->create('select');
        $view = $tree->create('listadmin');
        return  include($_SERVER['DOCUMENT_ROOT'].'/view/admin.php'); 
    }
    private function _delete($id = 0){
        $SQL="SELECT * FROM `object` WHERE parent=".$id;
        $result = $this->db->q($SQL);
        if ($result->num_rows > 0) {
            while ( $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ) {
                //print_r($row);
                $this->_delete($row["id"]); 

                $sqld = "DELETE FROM `object` WHERE id=".$row["id"];
                //print_r($sqld);
                $this->db->q($sqld); 
            }

        }
    }
}