
<?php echo $this->Form->create("Payment", array('class' => 'form', "action" => "edit/" . $this->data['Payment']['id'])); ?>
<?php
echo $this->Form->hidden('Payment.proyect_id');
echo $this->Form->hidden('Payment.id');
?>
<h1><center>INGRESO DEL DESEMBOLSO</center></h1>
<table border="0" width="100%">
    <tbody>
        <?php if ($group_id == 1 or $group_id == 6 or $group_id == 7): ?>
        <tr>
            <td><?php echo $this->Form->input('Payment.fecha_radicacion', array('class' => 'calendario', 'type' => 'text')); ?></td>
            <td><?php echo $this->Form->input('Payment.fecha_desembolso', array('class' => 'calendario', 'type' => 'text')); ?></td>
        </tr>
        <tr>
            <td>
                    <?php echo $this->Form->input('Payment.tipo', array('empty' => '', 'options' => array(
                        'Campesinos' => 'Campesinos', 
                        'Desplazados' => 'Desplazados', 
                        'Contrato plan' => 'Contrato plan', 
                        'Contrato plan cadena de valor' => 'Contrato plan cadena de valor', 
                        'Desplazados Cadena de valor' => 'Desplazados Cadena de valor', 
                        'Campesinos Cadena de valor' => 'Campesinos Cadena de valor',
                        'Campesinos PDRET cadena de valor' => 'Campesinos PDRET cadena de valor',
                        'Desplazados PDRET cadena de valor' => 'Desplazados PDRET cadena de valor',
                        'Campesinos PDRET contrato 563' => 'Campesinos PDRET contrato 563',
                        'Desplazados PDRET contrato 563' => 'Desplazados PDRET contrato 563',
                        'Campesinos 2015' => 'Campesinos 2015',
                        'Desplazados 2015' => 'Desplazados 2015'                        
                        ))); ?>
            </td>
            <td><?php echo $this->Form->input('Payment.beneficiary_id', array('label' => 'Beneficiario', 'empty' => '', 'class' => 'required')); ?></td> 
        </tr>
        <tr>
            <td><?php echo $this->Form->input('Payment.valor_desembolsado', array('type' => 'number', 'class' => 'required')); ?></td>
            <td><?php echo $this->Form->input('Payment.cuenta_beneficiario'); ?></td> 
        </tr>
        <tr>
            <td><?php echo $this->Form->input('Payment.tipo_cuenta_beneficiario', array('label' => 'Tipo de cuente del beneficiario', 'empty' => '', 'options' => array('Ahorros' => 'Ahorros', 'Corriente' => 'Corriente'))); ?></td> 
            <td><?php echo $this->Form->input('Payment.banco_beneficiario', array('label' => 'Banco del beneficiario')); ?></td> 
        </tr>
        <?php endif; ?>
        <tr>
            <td><?php echo $this->Form->input('Payment.observaciones'); ?></td>
            <td><?php echo $this->Form->input('Payment.formato', array('label' => 'Formato a utilizar', 'empty' => '', 'options' => array('F7' => 'F7-PA-GRF-05', 'F21' => 'F21-PA-GRF-01'))); ?></td>
        </tr>
    </tbody>
</table>
<?php
if(AuthComponent::User('group_id') == 1 or AuthComponent::User('group_id') == 7)
    echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button'));
if(($this->data['Payment']['fecha_desembolso']=='0000-00-00' or empty($this->data['Payment']['fecha_desembolso'])) and AuthComponent::User('group_id') != 1)
  echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button'));
  ?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Payments', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>