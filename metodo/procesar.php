<?php
if (isset($_POST['importar'])) {
    $url = "https://jsonplaceholder.typicode.com/users";
    $usuariosJson = file_get_contents($url);
    $usuarios = json_decode($usuariosJson, true);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practicaway";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    foreach ($usuarios as $usuario) {
        $nombre = $usuario['name'];
        $telefono = $usuario['phone'];
        $correo = $usuario['email'];
        $compania = $usuario['company']['name'];
        $calle = $usuario['address']['street'];
        $latitud = $usuario['address']['geo']['lat'];
        $longitud = $usuario['address']['geo']['lng'];

        $sql = "INSERT INTO usuarios (nombre, telefono, correo, compania, calle, latitud, longitud)
                VALUES ('$nombre', '$telefono', '$correo', '$compania', '$calle', '$latitud', '$longitud')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Usuario insertado correctamente: " . $nombre . "<br>";
        } else {
            echo "Error al insertar usuario: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

?>