<?php

$uri = isset($_GET['uri']) ? $_GET['uri'] : '/';

$uri = ltrim($uri, '/');

if(empty($uri)){        
    $uri = 'Home';
}

$pagePath = "pages/$uri/index.php";

if(file_exists($pagePath)){
    include($pagePath);
}else{
    include('pages/404/index.php');
}

?>