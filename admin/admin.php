<?php  
              $servername="localhost";
              $username="root";
              $password="";
              $dbname="bdencuesta1";

              //crear coneccion
              $conn=new mysqli($servername,$username,$password,$dbname);

              //check coneccion
              if ($conn->connect_error){
                  die("Coneccion fallada".$conn->connect_error);      }

              //consulta
              $querysql='UPDATE encuesta SET cantidad = 0';
              $result=$conn->query($querysql);
              require "admin.html";
              

              $conn->close();

            ?>