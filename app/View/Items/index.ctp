<?php echo $this->Session->flash(); ?>
<table id="tabla" width="100%" class="tabla">
    <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Alias</th>
            <th>Orden</th>
            <th>Menu</th>
            <th colspan="2">Opciones</th>

        </tr>
    </thead>
    <tbody>
       
        <?php foreach ($items as $item): ?>
    
            <tr>
                <td><?php echo $item['Item']['id'] ;?></td>
                <td><?php echo $item['Item']['nombre'] ?></td>
                <td><?php echo $item['Item']['alias'] ?></td>
                <td><?php echo $item['Item']['orden'] ?></td>
                <td><?php echo $item['Menu']['nombre'] ?></td>
                <td><?php echo $this->Ajax->link("Editar", array('controller' => "Items", "action" => "edit", $item['Item']['id']), array('update' => 'content')) ?></td>
                <td><?php echo $this->Ajax->link("Eliminar", array('controller' => "Items", "action" => "delete", $item['Item']['id']), array('update' => 'content'), '¿Esta seguro de eliminar el usuario? ') ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php




