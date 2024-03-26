<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<h2>Consumir API y Guardar en Base de Datos</h2>

<form action="../metodo/procesar.php" method="post">
    <input type="submit" value="Importar Usuarios" name="importar">
</form>

<button id="mostrarBoton">Mostrar</button>
<button id="cancelarBoton" style="display: none;">Cancelar</button>

<form id="usuarioForm" action="../metodo/registrar_usuario.php" method="POST" style="display: none;">
<input type="hidden" name="id_usu" id="id_usu">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono">
    </div>
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" class="form-control" id="correo" name="correo">
    </div>
    <div class="form-group">
        <label for="compania">Compañía:</label>
        <input type="text" class="form-control" id="compania" name="compania">
    </div>
    <div class="form-group">
        <label for="calle">Calle:</label>
        <input type="text" class="form-control" id="calle" name="calle">
    </div>
    <div class="form-group">
        <label for="latitud">Latitud:</label>
        <input type="text" class="form-control" id="latitud" name="latitud">
    </div>
    <div class="form-group">
        <label for="longitud">Longitud:</label>
        <input type="text" class="form-control" id="longitud" name="longitud">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

    <div class="container mt-5">
        <h2 class="mb-4">Lista de Usuarios</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Compañía</th>
                    <th>Calle</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
    $conexion = new mysqli('localhost', 'root', '', 'practicaway');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $consulta = "SELECT * FROM usuarios";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['telefono'] . "</td>";
            echo "<td>" . $fila['correo'] . "</td>";
            echo "<td>" . $fila['compania'] . "</td>";
            echo "<td>" . $fila['calle'] . "</td>";
            echo "<td>" . $fila['latitud'] . "</td>";
            echo "<td>" . $fila['longitud'] . "</td>"; ?>
            <input type="hidden" value="<?php echo $fila['id'];?>" name="txt_id_<?= $fila['id'] ?>" id="txt_id_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['nombre'];?>" name="txt_nombre_<?= $fila['id'] ?>" id="txt_nombre_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['telefono'];?>" name="txt_telefono_<?= $fila['id'] ?>" id="txt_telefono_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['correo'];?>" name="txt_correo" id="txt_correo_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['compania'];?>" name="txt_compania" id="txt_compania_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['calle'];?>" name="txt_calle" id="txt_calle_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['latitud'];?>" name="txt_latitud" id="txt_latitud_<?= $fila['id'] ?>">
            <input type="hidden" value="<?php echo $fila['longitud'];?>" name="txt_longitud" id="txt_longitud_<?= $fila['id'] ?>">
            <?php echo "<td>" . "<button class='btn btn-primary editarBtn' data-id='" . $fila['id'] . "'>Editar</button>" . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron usuarios.</td></tr>";
    }

    $conexion->close();
    ?>
            </tbody>
        </table>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<script>
var mostrarBoton = document.getElementById('mostrarBoton');
var cancelarBoton = document.getElementById('cancelarBoton');
var miFormulario = document.getElementById('usuarioForm');
mostrarBoton.addEventListener('click', function() {
    cancelarBoton.style.display = 'block';
    miFormulario.style.display = 'block';
    mostrarBoton.style.display = 'none';
    $('#usuarioForm')[0].reset();
    $('#id_usu').val('');
});

cancelarBoton.addEventListener('click', function() {
    mostrarBoton.style.display = 'block';
    miFormulario.style.display = 'none';
    cancelarBoton.style.display = 'none';
    $('#usuarioForm')[0].reset();
    $('#id_usu').val('');
});

 document.addEventListener("DOMContentLoaded", function() {
        var editarBtns = document.querySelectorAll(".editarBtn");

        editarBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                miFormulario.style.display = 'block';
                var idUsuario = $(this).data('id');
                $('#id_usu').val(document.getElementById('txt_id_'+idUsuario).value);
                $('#nombre').val(document.getElementById('txt_nombre_'+idUsuario).value);
                $('#telefono').val(document.getElementById('txt_telefono_'+idUsuario).value);
                $('#correo').val(document.getElementById('txt_correo_'+idUsuario).value);
                $('#compania').val(document.getElementById('txt_compania_'+idUsuario).value);
                $('#calle').val(document.getElementById('txt_calle_'+idUsuario).value);
                $('#latitud').val(document.getElementById('txt_latitud_'+idUsuario).value);
                $('#longitud').val(document.getElementById('txt_longitud_'+idUsuario).value);
               
                console.log('hola');
                console.log(idUsuario);
            });
        });
    });

    function mostrarDetallesUsuario(usuario) {
        document.getElementById("nombre").value = usuario.nombre;
        document.getElementById("telefono").value = usuario.telefono;
        document.getElementById("correo").value = usuario.correo;
        document.getElementById("compania").value = usuario.compania;
        document.getElementById("calle").value = usuario.calle;
        document.getElementById("latitud").value = usuario.latitud;
        document.getElementById("longitud").value = usuario.longitud;
        document.getElementById("formularioEdicion").style.display = "block";
    }
</script>