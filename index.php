<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

   </head>
<body>

<a href="importData.php">Ucitaj sve</a>

<p>Prikazi Sve Proizvode:</p>
<button id="products">PRODUCTS</button>


<p>Prikazi Sve Dobavljace:</p>
<button id="dobav">All Suppliers</button>


<p>
- prikazivanje svih proizvoda koje poseduje određeni Dobavljač<br />
Ime dobavljaca
<input id="supp_name" />
<button id="products_supp">PRODUCTS WITH SUPP</button>
</p>

<p>
- brisanje Dobavljača<br />
Id dobavljaca
<input id="supp_id_del" />
<button id="supp_del">DEL SUPP</button>
</p>

<p>
- brisanje Proizvoda<br />
Id Proizvoda
<input id="pro_id_del" />
<button id="pro_del2">DEL SUPP</button>
</p>


<p>
- edit Dobavljač<br />
Id dobavljaca
<input id="supp_id_edit" />
<br>
Novo ime dobavljaca
<input id="supp_name_edit" />
<button id="supp_edit">EDIT SUPP</button>
</p>
      <script>

    document.querySelector('#products').onclick = function(){
        fetch('api/products') 
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }

    document.querySelector('#dobav').onclick = function(){
        fetch('api/allsuppliers') 
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }


    document.querySelector('#products_supp').onclick = function(){
        var supp = document.querySelector('#supp_name').value;
        fetch('api/products/'+supp) 
       
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }

    document.querySelector('#supp_del').onclick = function(){
        var id = document.querySelector('#supp_id_del').value;
        fetch('api/suppliers_del/'+id) 
      
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }

    document.querySelector('#pro_del2').onclick = function(){
        var id = document.querySelector('#pro_id_del').value;
        fetch('api/product_del/'+id) 
      
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }
    document.querySelector('#supp_edit').onclick = function(){
        var id = document.querySelector('#supp_id_edit').value;
        var new_name = document.querySelector('#supp_name_edit').value;
        fetch('api/suppliers_upd/'+id+"/"+new_name) 
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }
    
    
    </script>






    
</body>
</html>