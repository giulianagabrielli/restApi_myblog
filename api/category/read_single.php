<?php 

    //Headers
    header('Access-Control-Allow-Origin: *'); //não precisa usar token. Libera o acesso
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

     //Instantiate DB & connect
     $database = new Database();
     $db = $database->connect(); //método connect em Database

     //Instantiate category object
    $category = new Category($db); //construtor pede o parâmetro $db

    //Get ID url
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get category
    $category->read_single();

    //Create array
    $cat_arr = array(
        'id'=> $category->id, 
        'name' => $category->name,
    );

    //Make JSON
    print_r(json_encode($cat_arr));