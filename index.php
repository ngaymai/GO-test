<?php
require __DIR__ . "/inc/config.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
if ((isset($uri[3]))) {
    $objProdController = new ProductController();
    if ($uri[3] == 'get-product' || $uri[3] == 'update-product') {
        $objProdController->productHandler();
    } elseif ($uri[3] == 'get-cart' || $uri[3] == 'update-cart') {
        $objProdController->cartHandler();
    } 
} 

