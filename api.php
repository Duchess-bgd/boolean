<?php
include_once 'baza.php';

$upit=$_GET['upit'];

if ($upit=='products'){
    if(isset($_GET['drugi'])){ 
        print_r ($baza->getProducts1($_GET['drugi']));
    }else{
        print_r ($baza->getProducts());
    }
}


if($upit == 'suppliers'){
    print_r ($baza->getProducts());
}

if($upit == 'allsuppliers'){
    print_r ($baza->getSuppliers());
}
if($upit == 'suppliers_del'){
    $id = $_GET['drugi'];
    print_r ($baza->deleteSupplier($id));
}

if($upit == 'product_del'){
    $id = $_GET['drugi'];
    print_r ($baza->deleteProduct($id));
}
if($upit == 'suppliers_upd'){
    $id = $_GET['drugi'];
    $vr = $_GET['treci'];
    print_r ($baza->updateSupplier($vr, $id));
}





//provera da li rade sve funkcije
 // $res = $baza->getAllData();
    //$dobavljaci= $baza->getSuppliers();
    //$proizvodi = $baza->getProducts();

   //$prodob = $baza->getProducts1("Lower Tech");

   //$updateS= $baza->updateSupplier("bbbb",1011);
  // $updateS=$baza->updateSupplier2("Luigi", "bbbb");
    
    //$put1 = $baza->deleteProduct(140);
    //$deleteS=$baza->deleteSupplier(1011);

    // $y=$baza->updateProducts(145,'Dellllll','jos nesto',17,56,100,2);


    // echo '<pre style="background:white;">';
    // print_r ($res);
    // echo '</pre>';
    // die;
    
    // echo '<pre style="background:white;">';
    // print_r ($y);
    // echo '</pre>';
    // die;
    
    
    // echo '<pre style="background:white;">';
    // print_r ($dobavljaci);
    // echo '</pre>';
    // die;
    
    // echo '<pre style="background:white;">';
    // print_r ($proizvodi);
    // echo '</pre>';
    // die;


?>