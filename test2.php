<?php

require_once('conn.php');

if(isset($_POST['question']))
{
    $tagsField = $_POST['tagsField'];
    $tags = explode(',',$tagsField); 
    echo var_dump($tags);
}

?>
