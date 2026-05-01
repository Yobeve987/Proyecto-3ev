<!DOCTYPE html>
<html>
<head>
    <title>Cambiar color de fondo</title>
</head>

<body style="background-color: <?= $_SESSION['fondo'] ?? 'white' ?>;">

    <h1>Personalizar color de fondo</h1>

    <p>Elige un color y se guardará como tu fondo personal.</p>

    <form method="POST" action="index.php?accion=cambiarColor">
        <label>Selecciona un color:</label><br><br>

        <input type="color" name="color" value="<?= $_SESSION['fondo'] ?? '#ffffff' ?>"
               style="width: 80px; height: 40px; cursor: pointer;">

        <br><br>
        <button type="submit">Guardar color</button>
    </form>

    <br>
    <a href="index.php">Volver al inicio</a>

</body> 
</html>
