<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($this->producto->id) ? 'Editar Producto' : 'Crear Nuevo Producto'; ?></title>
    <link rel="stylesheet" href="css/style.css"> </head>
<body>
    <div class="container">
        </div>
</body>
</html>
    <div class="container">
        <h1><?php echo isset($this->producto->id) ? 'Editar Producto' : 'Crear Nuevo Producto'; ?></h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="?action=<?php echo isset($this->producto->id) ? 'update' : 'create'; ?>" method="POST">
            <?php if (isset($this->producto->id)): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($this->producto->id); ?>">
            <?php endif; ?>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($this->producto->nombre ?? ''); ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($this->producto->descripcion ?? ''); ?></textarea>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($this->producto->precio ?? ''); ?>" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($this->producto->stock ?? ''); ?>" required>

            <label for="categoria">Categoría:</label>
            <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($this->producto->categoria ?? ''); ?>">

            <label for="imagen_url">URL de la Imagen:</label>
            <input type="url" id="imagen_url" name="imagen_url" value="<?php echo htmlspecialchars($this->producto->imagen_url ?? ''); ?>">

            <label>
                <input type="checkbox" name="activo" <?php echo (isset($this->producto->activo) && $this->producto->activo) ? 'checked' : ''; ?>>
                Activo
            </label>
            <br><br>

            <button type="submit" class="btn btn-success"><?php echo isset($this->producto->id) ? 'Actualizar Producto' : 'Crear Producto'; ?></button>
            <a href="?action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>