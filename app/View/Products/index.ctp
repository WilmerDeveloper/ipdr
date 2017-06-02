<div class="paging">
</div>
<div >
    <table id="tabla"  >
        <thead>
            <tr>
                <th style="width: 25%">Producto</th>
                <th style="width: 10%">Cantidad real</th>
                <th style="width: 20%">Valor unitario</th>
                <th colspan="2" style="width: 30%">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($Products as $product):
                ?>
                <tr>
                    <td><?php echo $product['ProductType']['nombre']; ?></td>
                    <td><?php echo $product['Product']['cantidad_real']; ?></td>
                    <td><?php echo $product['Product']['valor_unitario']; ?></td>
                    <td>
                        <br>
                        <?php echo $this->Ajax->link('Editar', array('controller' => 'Products', 'action' => 'edit', $product['Product']['id']), array('update' => 'content', 'class' => 'acciones')); ?>
                        <br>
                        <br>
                    </td>
                    <td>
                        <br>
                        <?php echo $this->Ajax->link('Eliminar', array('controller' => 'Products', 'action' => 'delete', $product['Product']['id'], $visit_id), array('update' => 'content', 'class' => 'acciones'), "¿Seguro desea eliminar este producto?"); ?>                        
                        <br>
                        <br>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>  
<br><br><br>

<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'visits', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar', array('controller' => 'Products', 'action' => 'add', $visit_id), array('update' => 'content', 'class' => 'acciones'));?></td>
        </tr>
    </tbody>
</table>


<br><br>