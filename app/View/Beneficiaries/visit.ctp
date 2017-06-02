
<fieldset>
    <?php 
    $l1="Se encuentra en la resolución del proyecto";
    $l2="No se encuentra en la resolución";
    ?>

    <?php echo $this->Form->create("Beneficiary", array("class" => "form", "action" => "visit/" . $this->data['Beneficiary']['id'])); ?>
    <?php echo $this->Form->hidden('Beneficiary.id'); ?>
    <?php echo $this->Form->hidden('Beneficiary.property_id'); ?>
    <?php if ($call_id!=1): ?>
    <?php echo $this->Form->input('Beneficiary.fallecido', array('label' => '¿El beneficiario ha fallecido?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('Beneficiary.sucesion', array('label' => 'El predio se encuentra en sucesión', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('Beneficiary.tipo_habitante', array('label' => '¿En que calidad habita el predio?', 'class' => '', 'empty' => '', 'options' => array('Propietario' => 'Propietario', 'Arrendatario' => 'Arrendatario', 'Otro' => 'Otro'))); ?>
    <?php echo $this->Form->input('Beneficiary.esta_en_listado', array('label' => '¿Está  en listado del INCODER?', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php echo $this->Form->input('Beneficiary.es_representante', array('label' => '¿Es representante de la comunidad?', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php 
    $l1="Cumple";
    $l2="No cumple";
    ?>
    <?php endif;?>
    <?php echo $this->Form->input('Beneficiary.calificacion_visita', array('label' => 'Calificación', 'class' => 'required', 'empty' => '', 'options' => array('Cumple' => $l1, 'No cumple' => $l2))); ?>
    <?php echo $this->Form->input('Beneficiary.concepto_visita', array('label' => 'Concepto', 'class' => 'required')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submitButton')) ?>
</fieldset>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Beneficiaries', 'action' => 'total_index', $this->data['Beneficiary']['property_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
