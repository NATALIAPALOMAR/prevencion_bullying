
<?php
require_once "db.php";

$mensaje_guardado = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mensaje = trim($_POST["mensaje"] ?? "");

    if ($mensaje !== "") {
        try {
           $sql = "INSERT INTO mensajes (mensaje, fecha) VALUES (:mensaje, NOW())";
            $consulta = $conexion->prepare($sql);
            $consulta->execute(["mensaje" => $mensaje]);
            $mensaje_guardado = true;
        } catch (PDOException $e) {
            $error = "No se pudo guardar el mensaje. Intenta nuevamente.";
        }
    } else {
        $error = "Escribe un mensaje antes de guardarlo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje de convivencia</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Mensaje de convivencia</h1>
        <p>Compartamos mensajes de respeto y empatía.</p>
    </header>

    <main>
        <section>
            <?php if ($mensaje_guardado): ?>
                <p>¡Tu mensaje se guardó correctamente!</p>
            <?php endif; ?>

            <?php if ($error !== ""): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" action="contacto.php">
                <label for="mensaje">Escribe tu mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="5" required maxlength="1000"></textarea>
                <button type="submit">Guardar mensaje</button>
            </form>

            <p><a href="index.php">Volver a la página principal</a></p>
        </section>
    </main>

    <footer>
        <p>Proyecto escolar: Prevención del Bullying</p>
    </footer>
</body>
</html>