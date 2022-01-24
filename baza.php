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


        function getAllData(){//radi
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

        function getSuppliers()//radi
        {
            $supp=$this->izvrsi_select("SELECT supplier.id,supplier.name FROM supplier");

            if($supp['uspesno'] == true){
                return json_encode($supp['niz']);
            }else{
                die("Neuspesan upit: ".$supp['poruka']);
            }
        }

        

        function deleteSupplier($id)//radi
        {
             return $p=$this->izvrsi_upit("DELETE FROM supplier WHERE id= $id ");

           
            if ($p == true){
                return ("obrisano");
            }else{
                die("nije obrisano".$p[1]);
            }
           

        }

        function deleteProduct($id)//radi
        {
            return $this->izvrsi_upit("DELETE FROM product WHERE id= $id ");

        }

        function getProducts()//radi
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


        function getProducts1($dobavljac)//radi
        {
            $pro1 = $this->izvrsi_select("SELECT product.id, 
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
                                            
                                            WHERE supplier.name LIKE '%$dobavljac%' ");

            if($pro1['uspesno'] == true){
                echo json_encode($pro1['niz']);
            }else{
                die("Neuspesan upit: ".$pro1['poruka']);
            }
        }


        function updateProducts($id,$part_desc,$part_number,$days_valid,$quantity,$price, $priority)//radi
        {
           return $newPro = $this->izvrsi_upit("UPDATE product SET id=$id,
                                                part_desc= '$part_desc',
                                                part_number='$part_number',
                                                days_valid=$days_valid,
                                                quantity=$quantity,
                                                price=$price,
                                                priority=$priority
                                                
                                                
                                                WHERE id=$id ");
            if($newPro['uspesno'] == true){
                echo json_encode($newPro['niz']);
            }else{
                die("Neuspesan upit: ".$newPro['poruka']);
            }
        }

        function updateSupplier($newname,$id)//radi
        {
            return $suppNew=$this->izvrsi_upit("UPDATE supplier SET name='$newname' WHERE id=$id ");

        }

        function updateSupplier2($newname, $name)//radi
        {
            return $suppNew2=$this->izvrsi_upit("UPDATE supplier SET name='$newname' WHERE name='$name' ");

        }


    }

    
    $baza = new Baza('goca');