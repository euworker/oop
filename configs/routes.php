<?php 

$routes = array (
    'ManufacturerController' => array (
        
        'manufacturer/add' => 'add',
        'manufacturer/edit/([0-9+])' => 'edit/$1',
        'manufacturer/delete/([0-9+])' => 'delete/$1',
        'manufacturers/page=([0-9+])' => 'index/$1',
        'manufacturers' => 'index'
        
         
    ),

    'UsersController' => array (
        'user/reg' => 'reg',
        'user/auth' => 'auth',
        'logout' => 'logout'
    ),

    'ProductsController' => array (
        'product/add' => 'add',
        'product/edit/([0-9+])' => 'edit/$1',
        'product/delete/([0-9+])' => 'delete/$1',
        'products' => 'index'
    )
    


);

?>