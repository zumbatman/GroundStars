<!DOCTYPE html>
<?php
$groups = json_decode(file_get_contents("data/groups.json"), true);
$group = $_GET['groupe'];
$id_get = $_GET['id'];
foreach($groups as $name => $id) {
    print_r($id);
    if($name == $group){
        foreach($id as $key => $value){
            if($id_get == $value){
                unset($groups[$name][$key]);
            }
        }
    }
}
file_put_contents("data/groups.json", json_encode($groups, JSON_PRETTY_PRINT));
header("Location: page02.php");
?>