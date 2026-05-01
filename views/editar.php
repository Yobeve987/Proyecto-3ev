<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>

    <form method="POST">
        Nombre:<br>
        <input type="text" name="nombre" value="<?= $producto->getnombre() ?>" required><br><br>

        Precio:<br>
        <input type="number" name="precio" value="<?= $producto->getprecio() ?>" required><br><br>

        Stock:<br>
        <input type="number" name="stock" value="<?= $producto->getstock() ?>" required><br><br>

        Descripción:<br>
         <input type="text" name="descripcion" value="<?= $producto->getdescripcion()) ?>" required><br><br>

        <?php if ($producto instanceof electronica): ?>
            Marca:<br>
            <input type="text" name="marca" value="<?= $producto->getmarca() ?>" required><br><br>

            Modelo:<br>
            <input type="text" name="modelo" value="<?= $producto->getmodelo() ?>" required><br><br>

            Garantia:<br>
            <input type="text" name="garantia" value="<?= $producto->getgarantia() ?>" required><br><br>
        <?php endif; ?>

        <?php if ($producto instanceof textil): ?>
            Talla:<br>
            <input type="number" name="talla" value="<?= $producto->gettalla() ?>" required><br><br>

            Material:<br>
            <input type="text" name="material" value="<?= $producto->getmaterial() ?>" required><br><br>

            Genero:<br>
            <input type="text" name="genero" value="<?= $producto->getgenero() ?>" required><br><br>
        <?php endif; ?>

        <button type="submit">Actualizar Producto</button>
    </form>

    <br>
    <a href="index.php">Volver al listado</a>
</body>
</html>