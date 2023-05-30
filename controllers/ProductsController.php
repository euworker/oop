<?php 
require_once("functions.php");

class ProductsController {
    private $productModel;
    private $manufacturerModel;
    public $isAuthorized;


    public function __construct() {
        $this->productModel = new Product();
        $this->manufacturerModel = new Manufacturer();
        $userModel = new User();
        $this->isAuthorized = $userModel->checkIfUserAuthorized();
        
        
    }

    public function actionIndex() { 
        $products = $this->productModel->getAll();
        $title = 'Товары';
        require_once("views/products/table.html");
    }

    public function actionAdd() {
        if (isset($_POST['product_art'])){
            $product_art = clean($_POST['product_art']);
            $product_name = clean($_POST['product_name']);
            $product_description = clean($_POST['product_description']);
            $product_price = clean($_POST['product_price']);
            $product_quantity = clean($_POST['product_quantity']);
            $product_img_link = clean($_POST['product_img_link']);
            // $product_warehouse_id = clean($_POST['product_warehouse_name']);
            $product_manufacturer_id = clean($_POST['product_manufacturer_name']);
            // $product_group_id = clean($_POST['product_group_name']);

            if (
                empty($product_art) 
                || check_length($product_art,1,40)
                || empty($product_name) 
                || check_length($product_name,1,100)
                || check_length($product_description,0,980)
                || name_check($product_name) === 1 
                || check_length($product_name,1,100)
                || empty($product_price) 
                || ($product_price < 0 ||  $product_price > 99999999)  
                || !is_numeric($product_price) 
                // || empty($product_warehouse_id)
                // || empty($product_group_id)
            )  
             {
                echo 'Не соблюдены условия!'; 
                
            } else {
                $data = array (
                   'product_art'=> $product_art,
                   'product_name'=> $product_name,
                    'product_description'=> $product_description,
                    'product_price' => $product_price,
                    'product_quantity' => $product_quantity,
                    'product_img_link' => $product_img_link,
                    'product_manufacturer_id' => $product_manufacturer_id
                );
                $this->productModel->add($data);
                header('Location: '. FULL_SITE_ROOT . 'products');
            }


        }


        $manufacturers = $this->manufacturerModel->getAll();
        include_once('views/products/form.html');
    }

    public function actionEdit($id) {

        $product = $this->productModel->getById($id);
        $product['manufacturers_getById'] = explode(',',$product['manufacturers_getById']);
        
        if (isset($_POST['product_art'])){
            $product_art = clean($_POST['product_art']);
            $product_name = clean($_POST['product_name']);
            $product_description = clean($_POST['product_description']);
            $product_price = clean($_POST['product_price']);
            $product_quantity = clean($_POST['product_quantity']);
            $product_img_link = clean($_POST['product_img_link']);
            // $product_warehouse_id = clean($_POST['product_warehouse_name']);
            $product_manufacturer_id = clean($_POST['product_manufacturer_name']);
            // $product_group_id = clean($_POST['product_group_name']);

            if (
                empty($product_art) 
                || check_length($product_art,1,40)
                || empty($product_name) 
                || check_length($product_name,1,100)
                || check_length($product_description,0,980)
                || name_check($product_name) === 1 
                || check_length($product_name,1,100)
                || empty($product_price) 
                || ($product_price < 0 ||  $product_price > 99999999)  
                || !is_numeric($product_price) 
                // || empty($product_warehouse_id)
                // || empty($product_group_id)
            )  
             {
                echo 'Не соблюдены условия!'; 
                
            } else {


                $data = array (
                   'product_art'=> $product_art,
                   'product_name'=> $product_name,
                    'product_description'=> $product_description,
                    'product_price' => $product_price,
                    'product_quantity' => $product_quantity,
                    'product_img_link' => $product_img_link,
                    'product_manufacturer_id' => $product_manufacturer_id
                );
                // забираем массив объект из базы. превращаем в масиив. сравниваем 2 массива. 
                // расхождение превращаем из масиива в строки  или инты для записи в базу, обновляем только новые стркои 
                //  if ( $this->productModel->dataDif($data,$product) == 1 ); 
                $this->productModel->edit($data,$id);
                header('Location: '. FULL_SITE_ROOT . 'products');
                
            }


        }


        $manufacturers = $this->manufacturerModel->getAll();
        include_once('views/products/form.html');
    }
    
    public function actionDelete($id) {
        $errors = [];
        // TODO проверка на то, что id передан правильно.
        // id соответствует регулярке 
        // id есть в базе
        $this->productModel->remove($id);
        header('Location: ' . FULL_SITE_ROOT . 'products');
    }

}


?>