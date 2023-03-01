<?php 
  require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
  $fun=$_POST['funcion'];
  $id=$_POST['id'];
  if ($fun==1) {
      $lista= mysqli_query($con,"SELECT c.id_reg,codigo_producto,nombre,c.cantidad FROM empp_tb_factura_cab a
        inner join empp_tb_cliente b on b.id_reg=a.id_cliente
        inner join empp_tb_factura_det c on c.id_regcab=a.id_reg
        inner join empp_tb_productos d on d.id_produc=c.id_producto
        WHERE a.id_reg='$id' and c.estado='1'");
      $con=1;
      foreach ($lista as $values) {
      echo "<tr id='fila".$values['id_reg']."'>";
      echo "<td><input  type='text' name='ids[]' value='".$values['id_reg']."'>".$con++."</td>";
      echo "<td><button style='color:white' class='btn btn-warning' onclick='eliminar(".$values['id_reg'].");'>X</button></td>";
      echo "<td>NO</td>";
      echo "<td><input  type='text' value='".$values['codigo_producto']."' name='cod_prod[]'>".$values['codigo_producto']."</td>";
      echo "<td><input  type='text' value='".$values['nombre']."' name='nombres[]'>".$values['nombre']."</td>";
      echo "<td> UNIDAD (ZZ) </td>";
      echo "<td><input  type='text' value='".$values['cantidad']."' name='cantidades[]'>".$values['cantidad']."</td>";
      echo "</tr>";
      }
  }
?>