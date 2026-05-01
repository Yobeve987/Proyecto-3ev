<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
    <style>
        .stockalto { background-color: #c8f7c5; } 
        .stockmedio { background-color: #ffd59e; } 
        .stockcero { background-color: #f7c5c5; } 
    </style>
<body style="background-color: <?= $_SESSION['fondo'] ?? 'white' ?>;">
    <h1>Lista de Productos</h1>

    <div style="background-color: #f0f0f0; padding: 10px; margin-bottom: 20px;">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            Bienvenido, <b><?= $_SESSION['usuarioEmail'] ?></b> | 
            <a href="index.php?accion=logout">Cerrar Sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login">Iniciar Sesión</a> | 
            <a href="index.php?accion=alta">Registrarse</a>
        <?php endif; ?>
    </div>

    <a href="index.php?accion=crear">Agregar Producto</a><p>
    <a href="index.php?accion=color">Cambiar color de fondo</a>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripción</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Garantia</th>
            <th>Talla</th>
            <th>Material</th>
            <th>Genero</th>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>

        <?php foreach ($producto as $p): ?>
        <tr>
            <td><?= $p->getId() ?></td>
            <td><?= ($p instanceof electronica) ? "electronica" : "textil"; ?></td>
            <td><?= $p->getnombre() ?></td>
            <td><?= $p->getprecio() ?></td>
            <?php
                $stock = (int) $p->getstock();
                $stockClass = $stock === 0 ? 'stockcero' : ($stock < 5 ? 'stockmedio' : 'stockalto');
            ?>
            <td class="<?= $stockClass ?>"><?= $stock ?></td>
            <td><?= $p->getdescripcion() ?></td>
            <td><?= ($p instanceof electronica) ? $p->getmarca() : "--"; ?></td>
            <td><?= ($p instanceof electronica) ? $p->getmodelo() : "--"; ?></td>
            <td><?= ($p instanceof electronica) ? $p->getgarantia() : "--"; ?></td>
            <td><?= ($p instanceof textil) ? $p->gettalla() : "--"; ?></td>
            <td><?= ($p instanceof textil) ? $p->getmaterial() : "--"; ?></td>
            <td><?= ($p instanceof textil) ? $p->getgenero() : "--"; ?></td>
            
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <td>
                    <a href="index.php?accion=editar&id=<?= $p->getId() ?>">Editar</a>
                    
                    <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>">Eliminar</a>
                    </td>
                <?php endif; ?>    

        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>