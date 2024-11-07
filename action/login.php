<?php
require_once($_SERVER['DOCUMENT_ROOT']. '/database/connection.php' );


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = $_POST['email'];
  $contrasena = $_POST['contrasena'];

  // Preparar la consulta SQL con un placeholder
  $sql = "SELECT contrasena FROM usuario WHERE email = :email";
  $stmt = $conexion->prepare($sql);

  // Asignar el valor del email al placeholder y ejecutar la consulta
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  // Obtener el resultado
  $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($resultado) {
    $contrasenaHash = $resultado['contrasena'];

    // Verificar la contraseña ingresada contra el hash almacenado
    if ($contrasena == $contrasenaHash) {
      echo "Autenticación exitosa. ¡Bienvenido!";
      header("Location: /index.php");
      exit(); 
    } else {
      echo "Contraseña incorrecta.";
    }
  } else {
    echo "No se encontró un usuario con ese correo.";
  }
} else {
  echo "Error: No se han enviado datos del formulario.";
}
?>