<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

   </head>
<body>
<button>Click Me</button>

<?php

include_once 'baza.php';
include_once 'importData.php';
include_once 'api.php';





         ?>
      
      <script>
    
    document.querySelector('button').onclick = function(){
        fetch('api.php?upit=products')
            .then(resp => resp.text())
            .then(txt => document.body.innerHTML += txt);
    }
    
    
    </script>






    
</body>
</html>