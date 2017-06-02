<?php echo $this->Session->flash(); ?>
<table id="tabla" class="tabla" >
    <thead>
        <tr>
            <th>ID </th>
            <th>Nombre</th>
            <th>Icono</th>
            <th colspan="2">Icono</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $men): ?>
            <tr>
                <td><?php echo $men['Menu']['id'] ?></td>
                <td><?php echo $men['Menu']['nombre'] ?></td>
                <td><?php echo $men['Menu']['icono'] ?></td>
                <td><?php echo $this->Ajax->link('editar', array('controller' => 'Menus', 'action' => 'edit', $men['Menu']['id']), array('update' => 'content')) ?></td>
                <td><?php echo $this->Ajax->link('eliminar', array('controller' => 'Menus', 'action' => 'delete', $men['Menu']['id']), array('update' => 'content'), '¿Esta seguro de borrar el menú?') ?></td>


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


