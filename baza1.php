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
                // $id = $this->conn->insert_id; //ako postoji A_I
                // echo 'Insertovan red sa ID: '.$id;
                // return $id;
                return [true, "Uspesno izvrsen upit!"];
            }
                
        }
        function izvrsi_insert($upit){
            try{
            $odg = $this->conn->query($upit);

            return $this->conn->insert_id;
            }catch (Exception $e){
                return 0;
            }
            // if($odg === false) 
            //     return 0;
            // else 
            //     return $this->conn->insert_id;
        }

    

// primer: 
        function daj_knjige(){
            $r = $this->izvrsi_select("select * from knjige");
            if($r['uspesno'] == true){
                return $r['niz'];
            }else{
                die("Neuspesan upit: ".$r['poruka']);
            }
        }
    }
    $baza = new Baza('goca');
    


?>