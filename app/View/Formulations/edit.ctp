<script>

    $(document).ready(function() {


        jQuery("#frm").validate({
            beforeSubmit: function() {
                $(".submit_button").hide();

            }
        });
    }

)
</script>
<div>
    <?php echo $this->Form->create("Formulation", array("id" => "frm", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Formulation']['id']))); ?>
    <table border="0">
        <tbody>
            
             <tr>
                <td><?php echo $this->Form->input('Formulation.familias_campesinas', array('label' => 'Número de familias campesinas', 'class' => 'required')); ?></td>
                <td><?php echo $this->Form->input('Formulation.familias_desplazadas', array('label' => 'Número de familias desplazadas', 'class' => 'required')); ?></td>
            </tr> 
            <tr>
                <td><?php echo $this->Form->input('Formulation.familias_indigenas', array('label' => 'Número de familias indigenas', 'class' => 'required')); ?></td>
                <td><?php echo $this->Form->input('Formulation.familias_negritudes', array('label' => 'Número de familias negritudes', 'class' => 'required')); ?></td>
            </tr> 
            <tr>
                <td><?php echo $this->Form->input('Formulation.familias_mujer_cabeza', array('label' => 'Número de familias mujer cabeza de familia', 'class' => 'required')); ?></td>
                <td><?php echo $this->Form->input('Formulation.familias_rom', array('label' => 'Número de familias rom', 'class' => 'required')); ?></td>
            </tr> 
            <tr>
                <td>Observaciones</td>
                <td><?php echo $this->Form->input('Formulation.observaciones', array('label' => '', 'class' => 'required')); ?></td>
            </tr> 
            <tr>
                <td colspan="2">Seguridad alimentaria:</td>
            </tr> 
            <tr>
                <td>Linea productiva:</td>
                <td><?php echo $this->Form->input('Formulation.seguridad_alimentaria', array('label' => '', 'class' => 'required')); ?></td>
            </tr> 
            <tr>
                <td>Costo seguridad alimentaria:</td>
                <td><?php echo $this->Form->input('Formulation.costo_seguridad', array('label' => '', 'class' => 'required')); ?></td>
            </tr> 
            <tr>
                <td>Adjuntar proyecto productivo</td>
                <td>
                    <?php echo $this->Form->file('Formulation.archivo', array('accept' => 'xsl|xlsx|pdf', 'class' => 'required')); ?>
                    <?php echo $this->Form->hidden('Formulation.proyect_id'); ?>
                    <?php echo $this->Form->hidden('Formulation.id'); ?>
                    <?php echo $this->Form->hidden('Formulation.user_id'); ?>
                </td>
            </tr> 
             
        </tbody>
    </table>


    <?php echo $this->Form->end(array('label'=>'Guardar','class'=>'submit_button')) ?>
</div>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Formulations', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>


