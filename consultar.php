<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title> Resultados Encuestas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font: 15px Montserrat, sans-serif;
      line-height: 1.8;
      color: black;
    }
    
    table{
      padding: 20px;
      width: 40%;
    }
  </style>
</head>
<body>


  <h3>Resultados hijo!!!! </h3>
  <div>
    <div style="float:left;">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['Juegos', 'Votos'],
            <?php
              //variables de coneccion    
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
              $querysql='SELECT elemento,cantidad FROM encuesta';
              $result=$conn->query($querysql);

              if($result->num_rows>0){
                  while ($row=$result->fetch_assoc()){
                      echo "['";
                      echo $row["elemento"]."',";
                      echo $row["cantidad"]."],";
                  }
                  echo "]);";
              } else {
                      echo "0 resultados";
              }

              //cerrar coneccion

              $conn->close();

            ?>


          var options = {
            title: 'Estadistica de Encuesta'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }
      </script>

      <div id="piechart" style="width: 600px; height: 500px;"></div>         
      
    </div>                


           <?php
                //variables de coneccion    
                $servername="localhost";
                $username="root";
                $password="";
                $dbname="bdencuesta1";

                //crear coneccion
                $conn=new mysqli($servername,$username,$password,$dbname);

                //check coneccion

                if ($conn->connect_error){
                    die("Coneccion fallada".$conn->connect_error);

                }

                

                // sumatoria
                $sql = 'SELECT SUM(cantidad) total FROM encuesta';
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()){
                $total = $row ["total"];
                }

                //consulta

                $querysql='SELECT id,elemento,cantidad FROM encuesta';
                $result=$conn->query($querysql);

                // tabla
                if($result->num_rows>0){
                    echo "<h1> Tabla de Resultado </h1>";
                    echo "<table border=1>";
                    echo "<tr> <td> id </td>  <td> Juego </td>    <td> Votos  </td>   <td> porcentaje  </td> </tr>  ";
                    while ($row=$result->fetch_assoc()){
                      if($total <> 0){
                        $p = $row["cantidad"] * 100 / $total;
                      }
                      else{
                        $p = 0;
                      }
                      $por = round($p,2);  
                        echo "<tr> <td>";
                        echo $row["id"]." </td> ";
                        echo "<td>".$row["elemento"]."</td>";
                        echo "<td align=center>".$row["cantidad"]."</td>";
                        echo "<td align=center>".$por. " %</td> </tr>";
                    }
                    echo "</table>";
                } else {
                        echo "0 resultados";
                }
               echo "<table border=1>";
               echo "<tr> <td> total </td> <td align=center>".$total."</td> </tr>";
               echo "</table>";
                //cerrar coneccion

                $conn->close();
                
                ?>
  </div>
  <div class="row">
         <br> <br>
         <a href="index.html"> Volver a la Encuesta</a>     
  </div>

</body>
</html>

