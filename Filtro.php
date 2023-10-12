<?php
class Filtrar {

    public function generarHTMLTarea($registro) {
        ob_start();
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <form class="form-check" action="" method="post">
                <input type="hidden" name="id" value="<?= $registro['id']; ?>">
                <input class="form-check-input" type="checkbox" name="completado" value="<?= $registro['completado']; ?>" onChange="this.form.submit()" id="tarea_<?= $registro['id']; ?>" <?= ($registro['completado'] == 1) ? 'checked' : ''; ?>>
                <label class="form-check-label <?= ($registro['completado'] == 1) ? 'tachado' : ''; ?>" for="checked" style="<?= ($registro['completado'] == 1) ? 'text-decoration: line-through;' : ''; ?>"><?= $registro['tarea']; ?></label>
            </form>
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="ms-2">Fecha: <?= $registro['fecha']; ?></div>
                    <div class="ms-2">Categoría: <?= $registro['categoria']; ?></div>
                    <a href="?id=<?= $registro['id']; ?>"><span class="badge bg-danger ms-2">x</span></a>
                </div>
            </div>
        </li>
        <?php
        return ob_get_clean();
    }
}