<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden</title>
    <link rel="stylesheet" href="./CSS/estilos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <form action="" method="POST">
        <?php
            error_reporting(0);
            
            require 'conexion/conexion.php';
            //$cn = mysqli_connect('localhost','root','','registroweb');
            /*$sql= "SELECT * FROM datos";*/
            $buscard = $_POST['txt-buscar'];

            if(isset($_POST['btn-buscar'])){
                if($buscard !=''){
                $sql = "SELECT * FROM DATOS D INNER JOIN ESTADOS E ON D.FK_ID_ESTADO = E.ID_ESTADO INNER JOIN TURNOS T ON T.ID_TURNO = D.FK_ID_TURNO WHERE d.telefono_dato = '$buscard' or d.nombre_ip_dato = '$buscard' or d.nombre_usuario_dato = '$buscard'";
                } else{
                    $sql = "SELECT * FROM DATOS D INNER JOIN ESTADOS E ON D.FK_ID_ESTADO = E.ID_ESTADO INNER JOIN TURNOS T ON T.ID_TURNO = D.FK_ID_TURNO ORDER BY D.id_dato ";
                }
            }else{
                $sql = "SELECT * FROM DATOS D INNER JOIN ESTADOS E ON D.FK_ID_ESTADO = E.ID_ESTADO INNER JOIN TURNOS T ON T.ID_TURNO = D.FK_ID_TURNO ORDER BY D.id_dato ASC";
            }

            $resultados = mysqli_query($cn,$sql);

            $n = mysqli_num_rows($resultados);

        include 'View/header.php';

        ?>
        
    </form>
    <!-----------------------------------------CUERPO----------------------------------------------->
    <form action="consultas/insertar.php" method="POST">
        <div class="contenedor-cuerpo">
            <!----------------------------------------REGISTRO DE DATOS----------------------------------------->
            <div class="contenedor-registro">
                <div class="titulo-registro"><i class="far fa-id-badge"></i> Registra los datos</div>

                <label for="">Supervisor</label>
                <input type="text" name="txt-super" value="" placeholder="ingresar supervisor">

                <label for="">IP</label>
                <input type="text" name="txt-ip" value="" placeholder="ingresar ip">

                <label for="">DNI</label>
                <input type="text" name="txt-dni" value="" placeholder="ingresar dni">

                <label for="">Asesor</label>
                <input type="text" name="txt-as" value="" placeholder="ingresar asesor">

                <label for="">Telefono</label>
                <input type="text" name="txt-tel" value="" placeholder="ingresar telefono">

                <label for="">VPN</label>
                <input type="text" name="txt-vpn" value="" placeholder="ingesar vpn">

                <label for="">Tecnico</label>
                <input type="text" name="txt-tec" value="" placeholder="ingresar tecnico">
                <!-- <label for="">Fecha de Registro</label>--->
                <!--<input type="text" name="txt-fecha" value="<?php echo $fecha; ?>" readonly>-->
                
                <label for="">Grupo</label>
                <input type="text" name="txt-grupo" value="" placeholder="ingresar grupo">
                
                <label for="">Estado</label>
                <select name="txt-estado" id="" required> 
                    <option value="">Seleccionar</option>
                    <option value="1">Habilitado</option>
                    <option value="2">Pendiente</option>
                </select>

                <!--<input type="text" name="txt-estado2" value="" placeholder="ingresar estado">--->
                <label for="">Turno</label>
                <select name="txt-turno" id="" required>
                    <option value="">Seleccionar</option>
                    <option value="1">Mañana</option>
                    <option value="2">Tarde</option>
                </select>
                <!--<input type="text" name="txt-turno2" value="" placeholder="ingresar turno">-->
                <!-------BOTON REGISTRAR------>
                <button name="btn-registrar" class="btn-form"><i class="fas fa-save"></i></button>
            </div>
    </form>
            <!---------------------------------------MOSTRAR DATOS------------------------------------>
            <div class="contenedor-mostrar">
                <table class="tabla-datos">
                    <tr>
                        <th>E</th>
                        <th>D</th>
                        <th>SUPERVISOR</th>
                        <th>IP</th>
                        <th>DNI</th>
                        <th>ASESOR</th>
                        <th>TELEFONO</th>
                        <th>VPN</th>
                        <th>TECNICO</th>
                        <th>FECHA REGISTRO</th>
                        <th>GRUPO</th>
                        <th>ESTADO</th>
                        <th>TURNO</th>
                    </tr>
    <?php 
        while($row= mysqli_fetch_array($resultados)) {
    ?>
                    <tr>
                        <td><a href="View/editar.php?id=<?php echo $row['id_dato']; ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="consultas/delete.php?id=<?php echo $row['id_dato']; ?>"><i class="fas fa-trash"></i></a></td>
                        <td><?php echo $row['nombre_sup_dato']; ?></td>
                        <td><?php echo $row['nombre_ip_dato']; ?></td>
                        <td><?php echo $row['dni_dato']; ?></td>
                        <td><?php echo $row['nombre_usuario_dato']; ?></td>
                        <td><?php echo $row['telefono_dato']; ?></td>
                        <td><?php echo $row['nombre_vpn_dato']; ?></td>
                        <td><?php echo $row['nombre_tecnico_dato']; ?></td>
                        <td><?php echo $row['fecha_dato']; ?></td>
                        <td><?php echo $row['grupo_dato']; ?></td>
                        <td><?php echo $row['nombre_estado']; ?></td>
                        <td><?php echo $row['nombre_turno']; ?></td>
                    </tr>
    <?php } ?>
                </table>
            </div>
            <!--------------------------------------------------PIE DE PAGINA ----------------------------------------->
        </div>
    <?php include 'View/footer.html'; ?>
</body>
</html>