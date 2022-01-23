<?php

$upit=$_GET['upit'];

if ($upit=='product')

print_r ($baza->getProducts());




 // $res = $baza->getAllData();
    //$dobavljaci= $baza->getSuppliers();
    //$proizvodi = $baza->getProducts();

   //$prodob = $baza->getProducts1("Lower Tech");

   //$updateS= $baza->updateSupplier("bbbb",1011);
  // $updateS=$baza->updateSupplier2("Luigi", "bbbb");
    
    //$put1 = $baza->deleteProduct(140);
    //$deleteS=$baza->deleteSupplier(1011);

    $y=$baza->updateProducts(145,'Dellllll','jos nesto',17,56,100,2);


    // echo '<pre style="background:white;">';
    // print_r ($res);
    // echo '</pre>';
    // die;
    
    echo '<pre style="background:white;">';
    print_r ($y);
    echo '</pre>';
    die;
    
    
    // echo '<pre style="background:white;">';
    // print_r ($dobavljaci);
    // echo '</pre>';
    // die;
    
    // echo '<pre style="background:white;">';
    // print_r ($proizvodi);
    // echo '</pre>';
    // die;
    
    















?>