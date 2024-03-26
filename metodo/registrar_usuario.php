<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_usu"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $compania = $_POST["compania"];
    $calle = $_POST["calle"];
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practicaway";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    if($id > 0){
        $sql = "UPDATE usuarios SET nombre = '$nombre', telefono = '$telefono', correo = '$correo', compania = '$compania', calle = '$calle', latitud = '$latitud', 
        longitud =  '$longitud'  WHERE id = $id";
     
        if ($conn->query($sql) === TRUE) {
            echo "Usuario actualizado correctamente";
        } else {
            echo "Error al actualizar el usuario: " . $conn->error;
        }
        echo '<meta http-equiv="refresh" content="3;url=../vistas/usuariosv.php">';
    }else{
        $sql = "INSERT INTO usuarios (nombre, telefono, correo, compania, calle, latitud, longitud)
                VALUES ('$nombre', '$telefono', '$correo', '$compania', '$calle', '$latitud', '$longitud')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado correctamente";
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
        echo '<meta http-equiv="refresh" content="3;url=../vistas/usuariosv.php">';

    }

    $conn->close();
}
?>