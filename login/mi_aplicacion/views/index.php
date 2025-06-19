<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Productos</h1>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <a href="?action=createForm" class="btn btn-primary">Crear Nuevo Producto</a>

        <?php if ($num > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th> <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td>
                                <?php if (!empty($row['imagen_url'])): ?>
                                    <img src="<?php echo htmlspecialchars($row['imagen_url']); ?>" alt="Imagen de <?php echo htmlspecialchars($row['nombre']); ?>" alt="Imagen de Producto" style="width: 50px; height: auto; border-radius: 5px;">
                                <?php else: ?>
                                    Sin Imagen
                                <?php endif; ?>
                            </td> <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                            <td>$<?php echo htmlspecialchars(number_format($row['precio'], 2)); ?></td>
                            <td><?php echo htmlspecialchars($row['stock']); ?></td>
                            <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                            <td><?php echo $row['activo'] ? 'Sí' : 'No'; ?></td>
                            <td>
                                <a href="?action=editForm&id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay productos registrados.</p>
        <?php endif; ?>
    </div>
</body>
</html>