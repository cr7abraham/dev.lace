<?php 
  include("includes/conexion.php");
 $con = mysqli_connect($host, $user, $pwd, $db);
          if (mysqli_connect_errno()) {
            echo "Fallио la conexiиоn:".mysqli_connect_error();
          }


          $sql = "SELECT *
                  FROM usuarios
                  WHERE n_user = '$Usuario' AND contrasena = '$password'" ;

         $query  = mysqli_query($con, $sql);
         $fila   = mysqli_fetch_array($query, MYSQLI_ASSOC);
       if (!empty($fila['n_user']) && !empty($fila['contrasena'])){
         session_start();
               $_SESSION['valueuser'] = $fila['n_user'];
               $_SESSION['me'] = "menu"; 
        
        header ("Location: menu.php");
       }
       else {
        
       }
