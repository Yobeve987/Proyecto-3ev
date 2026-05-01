<!DOCTYPE html>
<html>
<head>
    <title>Añadir Producto</title>
</head>
<body>
    <h1>Añadir Producto</h1>

    <form method="POST">
        Tipo:<br>
        <select type="text" name="tipo" required>
            <option value="electronica">electronica</option>
            <option value="textil">textil</option>
        </select><br><br>
        Nombre:<br>
        <input type="text" name="nombre" required><br><br>
        Precio:<br>
        <input type="number" name="Precio" required><br><br>
        Stock:<br>
        <input type="number" name="stock" required><br><br>
        Descripción:<br>
        <input type="text" name="descripcion" required><br><br>
        Marca:<br>
        <input type="text" name="marca"><br><br>
        Modelo:<br>
        <input type="text" name="modelo"><br><br>
        Garantia:<br>
        <input type="text" name="garantia"><br><br>
        Talla:<br>
        <input type="number" name="cilindrada"><br><br>
        Material:<br>
        <input type="text" name="material"><br><br>
        Genero:<br>
        <input type="text" name="genero"><br><br>
        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="index.php">Volver</a>
</body>
</html>