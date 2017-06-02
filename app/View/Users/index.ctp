<form style="clear: both" >
    <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
        <tr>
            <td ><input type="text"  name="data[User][busqueda]" style="width: 130px" ></td>
            <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Users', 'action' => 'index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
        </tr>
    </table>
</form>
<table id="tabla" class="tabla" width="80%">
   

    <tbody>
        <?php foreach ($User as $usuario): ?>
            <tr>

                <td><?php echo $usuario['User']['username'] ?> </td>
                <td><?php echo $usuario['User']['nombre'] ?></td>
                <td><?php echo $usuario['User']['primer_apellido'] ?></td>
                <td style="font-size: small">
                    <table border="0" style="width:50px">
                           
                           
                                <tr>
                                    <td><?php echo $usuario['Branch']['nombre'] ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo substr($usuario['User']['email'], 0, 30) ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $usuario['Group']['name'] ?></td>
                                </tr>
                               
                          
                        </table>

                    
                
                </td>
               
                
                <td><?php echo $this->Ajax->link("editar", array('controller' => "Users", "action" => "edit", $usuario['User']['id']), array('update' => 'content')) ?></td>
                <td><?php echo $this->Ajax->link("eliminar", array('controller' => "Users", "action" => "delete", $usuario['User']['id']), array('update' => 'content'), '¿Esta seguro de eliminar el usuario? ') ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>







