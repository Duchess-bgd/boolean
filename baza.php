<?php

    class Baza{
        public $conn;

        function __construct($baza){
            $this->conn = new mysqli('localhost', 'root', '', $baza);
            // provera
            if ($this->conn->connect_error)
                die('Greska: '. $this->conn->connect_error);
        }

        function izvrsi_select($upit){
            $podaci = $this->conn->query($upit);
            if($podaci === false)
                return ['uspesno'=>false, 'poruka'=>$this->conn->error];
            else{
                $niz = $podaci->fetch_all(MYSQLI_ASSOC);
                return ['uspesno'=>true, 'niz'=>$niz];
            }
        }
        function izvrsi_upit($upit){
            $odg = $this->conn->query($upit);
            if($odg === false) {
                return [false, 'Nije izvrsen upit: ' . $this->conn->error];
            } else {
                //$id = $this->conn->insert_id; //ako postoji A_I
                //echo 'Insertovan red sa ID: '.$id;
                //return $id;
                return [true, "Uspesno izvrsen upit!"];
            }
                
        }
        function izvrsi_insert($upit){
            try {
                $odg = $this->conn->query($upit);
                return $this->conn->insert_id;
            } catch (Exception $e) {
                return 0;
            }

        }


        function getAllData(){
            $r = $this->izvrsi_select("SELECT product.id, 
                                                    product.part_desc, 
                                                    product.part_number, 
                                                    product.days_valid, 
                                                    product.price, 
                                                    product.priority, 
                                                    category.category, 
                                                    state.state, 
                                                    supplier.name 
                                            FROM  product 
                                            JOIN category ON product.category_id = category.id 
                                            JOIN state ON product.state_id = state.id 
                                            JOIN supplier ON product.supplier_id = supplier.id ");
            if($r['uspesno'] == true){
                return json_encode($r['niz']);
            }else{
                die("Neuspesan upit: ".$r['poruka']);
            }
        }

        function getSuppliers()
        {
            $supp=$this->izvrsi_select("SELECT supplier.id,supplier.name FROM supplier");

            if($supp['uspesno'] == true){
                return json_encode($supp['niz']);
            }else{
                die("Neuspesan upit: ".$supp['poruka']);
            }
        }
        
        function updateSupplier($newname,$id)
        {
            $suppNew=$this->izvrsi_select("UPDATE `supplier` SET `name`=$newname WHERE `id`=$id;");

            if($suppNew['uspesno'] == true){
                return json_encode($suppNew['niz']);
            }else{
                die("Neuspesan upit: ".$suppNew['poruka']);
            }
        }

        function deleteSupplier($id,$name)
        {
            $suppDel=$this->izvrsi_select("DELETE FROM `supplier` WHERE `id`= $id OR `name`=$name");

            if($suppDel['uspesno'] == true){
                return ('obrisano');
            }else{
                die("Neuspesan upit: ".$suppDel['poruka']);
            }
        }

        function getProducts()
        {
            $pro = $this->izvrsi_select("SELECT product.id, 
                                                    product.part_desc, 
                                                    product.part_number, 
                                                    product.days_valid, 
                                                    product.price, 
                                                    product.priority, 
                                                    category.category, 
                                                    state.state, 
                                                    supplier.name 
                                            FROM  product 
                                            JOIN category ON product.category_id = category.id 
                                            JOIN state ON product.state_id = state.id 
                                            JOIN supplier ON product.supplier_id = supplier.id ");
            if($pro['uspesno'] == true){
                echo json_encode($pro['niz']);
            }else{
                die("Neuspesan upit: ".$pro['poruka']);
            }
        }


        function getProducts($dobavljac)
        {
            $pro = $this->izvrsi_select("SELECT product.id, 
                                                    product.part_desc, 
                                                    product.part_number, 
                                                    product.days_valid, 
                                                    product.price, 
                                                    product.priority, 
                                                    category.category, 
                                                    state.state, 
                                                    supplier.name 
                                            FROM  product 
                                            JOIN category ON product.category_id = category.id 
                                            JOIN state ON product.state_id = state.id 
                                            JOIN supplier ON product.supplier_id = supplier.id
                                            
                                            WHERE supplier.name=$dobavljac ");
            if($pro['uspesno'] == true){
                echo json_encode($pro['niz']);
            }else{
                die("Neuspesan upit: ".$pro['poruka']);
            }
        }

        function deleteProduct($id)
        {
            $proDel=$this->izvrsi_select("DELETE FROM `product` WHERE `id`= $id ");

            if($proDel['uspesno'] == true){
                return ('obrisano');
            }else{
                die("Neuspesan upit: ".$proDel['poruka']);
            }
        }

        function updateProducts($id,$part_desc,$part_number,$days_valid,$quantity,$price, $category_id, $priority, $state_id, $supplier_id)
        {
            $newPro = $this->izvrsi_select("UPDATE `product` SET `id`=$id,
                                                `part_desc`= $part_desc,
                                                `part_number`=$part_number,
                                                `days_valid`=$days_valid,
                                                `quantity`=$quantity,
                                                `price`=$price,
                                                `category_id`=$category_id,
                                                `priority`=$priority,
                                                `state_id`=$state_id,
                                                `supplier_id`=$supplier_id 
                                                
                                                WHERE `id`=$id ");
            if($newPro['uspesno'] == true){
                echo json_encode($newPro['niz']);
            }else{
                die("Neuspesan upit: ".$newPro['poruka']);
            }
        }



    }
    $baza = new Baza('goca');
    
    $res = $baza->getAllData();

    $dobavljaci= $baza->getSuppliers();

// echo '<pre style="background:white;">';
// print_r ($res);
// echo '</pre>';
// die;


echo '<pre style="background:white;">';
print_r ($dobavljaci);
echo '</pre>';
die;

// echo '<pre style="background:white;">';
// print_r ($proizvodi);
// echo '</pre>';
// die;
