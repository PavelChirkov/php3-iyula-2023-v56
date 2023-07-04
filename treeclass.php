<?php

 class treeclass{
    private $db;
    private $name ='';


    function __construct($url = '') {
        $this->db = new DBClass();
    }
    public function create($type = 'select'){
       return $this->show_tree($type, 0, 0);
    }

    private function show_tree($type = '',$ParentID, $lvl) { 
        $lvl++; 
        $SQL="SELECT * FROM `object` WHERE parent=".$ParentID." ";
        $result = $this->db->q($SQL);
        $r = '';
        if ($result->num_rows > 0) {
            if($type == 'select' && $lvl == 1){
                $r .= '<select name="parent"> <option value="0">Нет родительского элемента</option>'; 
            }else if($type == 'list'){
                $r .= '<ul class="ullist">';
            }else if($type == 'listadmin'){
                $r .= '<ul>';
            }

            if($lvl >1 && $type == 'list'){
                $r .= '<details>';
            }
            while ( $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ) {

                if($type == 'select'){
                    $r .= '<option value="'.$row["id"].'">'; 
                }else if($type == 'list'){
                    $r .= '<li data-description="'.$row["description"].'">';
                }else if($type == 'listadmin'){
                    $r .= '<li>';
                }



                if($type == 'listadmin'){
                    $r .= '
                    <form action="/update?id='.$row["id"].'" method="POST"><input name="name" value="'.$row["name"].'"><textarea name="description">'.$row["description"].'</textarea><input type="submit" value="Изменить"></form>
                    <a href="/delete?id='.$row["id"].'">Удалить</a>
                    '; 
                }else{
                    for($l=1;$l<=$lvl;$l++){
                        $r .= '-';
                    }
                    $r .= $row["name"];
                }

                $r .= $this->show_tree($type, $row["id"], $lvl); 


                if($type == 'select'){
                    $r .= '</option value="'.$row["id"].'">'; 
                }else if($type == 'list'){
                    $r .= '</li>';
                }else if($type == 'listadmin'){
                    $r .= '</li>';
                }
            }

            if($lvl >1 && $type == 'list'){
                $r .= '</details>';
            }
            if($type == 'select' && $lvl == 1){
                $r .= '</select>'; 
            }else if($type == 'list'){
                $r .= '</ul>';
            }else if($type == 'listadmin'){
                $r .= '</ul>';
            }


            $lvl++;
        }
        return $r;
    }

 }