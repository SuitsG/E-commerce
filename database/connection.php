<?php

// Configuración de conexión
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'lauraSupremasy';
$nameTable = 'usuario';

try {
  // Conexión al servidor de MySQL (sin especificar una base de datos aún)
  $conexion = new PDO("mysql:host=$host", $username, $password);
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Crear la base de datos si no existe
  $conexion->exec("CREATE DATABASE IF NOT EXISTS $dbname");

  $conexion->exec("USE $dbname");

  // Crear la tabla si no existe
  $sqlCrearTabla = "CREATE TABLE IF NOT EXISTS $nameTable (
        idUsuario INT AUTO_INCREMENT PRIMARY KEY,
        nombreUsuario VARCHAR(50) NOT NULL,
        apellidoUsuario VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        contrasena VARCHAR(50) NOT NULL
    )";

  $conexion->exec($sqlCrearTabla);
} catch (PDOException $e) {
  die("Error en la conexión: " . $e->getMessage());
}
