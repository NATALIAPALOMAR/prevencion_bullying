
<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "prevencion_bullying";

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$base_datos;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $e) {
    die("Error al conectar con la base de datos.");
}
?>
