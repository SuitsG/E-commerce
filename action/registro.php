<?php
require_once($_SERVER['DOCUMENT_ROOT']. '/database/connection.php' );


// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Recibir los datos del formulario
  $nombreUsuario = $_POST['nombre'];
  $apellidoUsuario = $_POST['apellido'];
  $email = $_POST['email'];
  $contrasena = $_POST['contrasena'];
  
  
  // Preparar la consulta SQL para insertar los datos
  $sql = "INSERT INTO usuario (nombreUsuario, apellidoUsuario, email, contrasena) 
            VALUES (:nombreUsuario, :apellidoUsuario, :email, :contrasena)";
  
  $stmt = $conexion->prepare($sql);

  // Asignar los valores a los parámetros y ejecutar la consulta
  $stmt->bindParam(':nombreUsuario', $nombreUsuario);
  $stmt->bindParam(':apellidoUsuario', $apellidoUsuario);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':contrasena', $contrasena);
  

  if ($stmt->execute()) {
    echo "Empleado registrado exitosamente.";
  } else {
    echo "Hubo un error al registrar al empleado.";
  }
} else {
  echo "Error: No se han enviado datos del formulario.";
}

?>