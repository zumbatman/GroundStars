<!DOCTYPE html>
<?php
$groups = json_decode(file_get_contents("data/groups.json"), true);
$id_group = $_GET['groupe'];
$id_get = intval($_GET['id']);
$id_groups = $groups[$id_group];
$KnownID = false;
$key = array_search($id_get, $id_groups);
if ($id_groups != null && $key !== false) {
    $KnownID = true;
    unset($id_groups[$key]);
}
if ($KnownID == false){
    if(empty($id_groups) == true){
    $id_groups = [$id_get];
    }else {
    $id_groups[] = $id_get;
    }
}
$groups[$id_group] = $id_groups;
file_put_contents("data/groups.json", json_encode($groups, JSON_PRETTY_PRINT));
header("Location: admin_vue2.php");
?>