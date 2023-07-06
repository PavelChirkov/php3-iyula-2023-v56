<?php

 class treeclass{
    private $db;

    function __construct() {
        $this->db = &$GLOBALS['db'];
    }
    public function create(string $type = 'select'){
       return $this->show_tree($type, 0, 0);
    }

    private function show_tree(string $ttype,int $ParentID, int $lvl) { 
        
        $SQL="SELECT * FROM `object` WHERE parent=".$ParentID." ";
        $result = $this->db->q($SQL);
        $r = '';
        if ($result->num_rows > 0) {
            $lvl++; 
            if($ttype == 'select' && $lvl == 1){
                $r .= '<select name="parent"> <option value="0">Нет родительского элемента</option>'; 
            }else if($ttype == 'list'){
                $r .= '<ul class="ullist">';
            }else if($ttype == 'listadmin'){
                $r .= '<ul>';
            }

            if($lvl >1 && ($ttype == 'list' || $ttype == 'listadmin')){
                $r .= '<details>';
            }
            while ( $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ) {

                if($ttype == 'select'){
                    $r .= '<option value="'.$row["id"].'">'; 
                }else if($ttype == 'list'){
                    $r .= '<li data-description="'.$row["description"].'">';
                }else if($ttype == 'listadmin'){
                    $r .= '<li>';
                }



                if($ttype == 'listadmin'){
                    $r .= '
                    <form action="/update?id='.$row["id"].'" method="POST"><input name="name" value="'.$row["name"].'"><br><textarea name="description">'.$row["description"].'</textarea><br><input type="submit" value="Изменить"></form>
                    <a href="/delete?id='.$row["id"].'">Удалить</a>
                    '; 
                }else{
                    for($l=1;$l<=$lvl;$l++){
                        $r .= '-';
                    }
                    $r .= $row["name"];
                }

                $r .= $this->show_tree($ttype, $row["id"], $lvl); 


                if($ttype == 'select'){
                    $r .= '</option value="'.$row["id"].'">'; 
                }else if($ttype == 'list'){
                    $r .= '</li>';
                }else if($ttype == 'listadmin'){
                    $r .= '</li>';
                }
            }

            if($lvl >1 && ($ttype == 'list' || $ttype == 'listadmin')){
                $r .= '</details>';
            }
            if($ttype == 'select' && $lvl == 1){
                $r .= '</select>'; 
            }else if($ttype == 'list'){
                $r .= '</ul>';
            }else if($ttype == 'listadmin'){
                $r .= '</ul>';
            }


            $lvl++;
        }
        return $r;
    }

 }