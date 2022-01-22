<?php
//treba vremena da se sve izvrsi - postavi max vreme na 100 sekundi umesto na 30 koji je default
set_time_limit(100);

    include_once 'baza.php';

            
            $csvFile = fopen("suppliers.csv", 'r');


            
            // Skip the first line
            fgetcsv($csvFile);
            
            $sups = [];
            $cats = [];
            $cons = [];

            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                
                $supplier_name = $line[0];
                $part_desc  = $line[4];
                $part_number  = $line[3];
                $days_valid = $line[1];
                $quantity = $line[5];
                $price = $line[6];
                $priority = $line[2];
                $category = $line[8];
                $condition = $line[7];
                
                if($category != ''){
                    $ret = $baza->izvrsi_insert("INSERT INTO `category`(`category`) VALUES ('$category')");
                    // ako vrati id, snimi ga
                    if($ret > 0) $cats[$category] = $ret;

                    // ako ne vrati, znaci upis nije izvrsen jer vec postoji ta kategorija i to je vec snimljeno u $cats['$category']
                }
                
                if($condition != ''){
                    $ret = $baza->izvrsi_insert("INSERT INTO `state`(`state`) VALUES ('$condition')");
                    if($ret > 0) $cons[$condition] = $ret;
                }

                if($supplier_name != ''){
                    $ret = $baza->izvrsi_insert("INSERT INTO `supplier`(`name`) VALUES ('$supplier_name')");
                    if($ret > 0) $sups[$supplier_name] = $ret;
                }

                if($part_number != ''){
                    $ret = $baza->izvrsi_insert("INSERT INTO `product`(`part_desc`, `part_number`, `days_valid`, `quantity`, `price`, `priority`, `category_id`, `state_id`, `supplier_id`) VALUES ('$part_desc', '$part_number','$days_valid','$quantity','$price','$priority', "
                    .$cats[$category]. ", " 
                    .$cons[$condition]. ", " 
                    .$sups[$supplier_name]. ")" );
                    
                }else{
                    $ret = $baza->izvrsi_insert("INSERT INTO `product`(`part_desc`) VALUES ('$part_desc')");
                }
                if($ret === 0){
                    echo "<p>GRESKA PRODUCT ZA RED: </p>";
                    echo "<p>".json_encode($line)."</p>";
                    echo "<p>======================</p>";
                }
                
            }
            
            // Close opened CSV file
            fclose($csvFile);
            echo "<p>======================</p>";
            echo "Zavrseno";
    
