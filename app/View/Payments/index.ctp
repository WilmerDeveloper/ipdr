

<?php
$res = false;
if (file_exists("../webroot/files/" . $Resolution['Proyect']['id'] . "-" . $Resolution['Proyect']['codigo'] . "/" . $Resolution['Resolution']['adjunto']) and $Resolution['Resolution']['adjunto'] != "") {
    echo $this->Html->link('Adjunto Resolución ', "../files/" . $Resolution['Proyect']['id'] . "-" . $Resolution['Proyect']['codigo'] . "/" . $Resolution['Resolution']['adjunto'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
    $res = true;
} else {
    echo"<h1 style='color:red'>No se ha adjuntado la resolución</h1>";
}
?>
<br>
<br>
<table style="font-size: small" border="1">
    <tr>
        <td>Beneficiario</td>
        <td>Fecha radicado</td>
        <td>Fecha de desembolso</td>
        <td>Cuenta beneficiario</td>
        <td>Valor desembolsado</td>

        <td colspan="2"></td>
    </tr>
    <?php $total = 0; ?>
    <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?php echo $payment['Beneficiary']['nombres'] . " " . $payment['Beneficiary']['primer_apellido'] ?></td>
            <td><?php echo $payment['Payment']['fecha_radicacion'] ?></td>
            <td><?php echo $payment['Payment']['fecha_desembolso'] ?></td>
            <td><?php echo $payment['Payment']['cuenta_beneficiario'] ?></td>
            <td><?php
                echo "$ " . number_format($payment['Payment']['valor_desembolsado'], 2, ',', '.');
                $total+=$payment['Payment']['valor_desembolsado'];
                ?></td>
            <td>
                <?php echo $this->Ajax->link('Editar', array('controller' => 'payments', 'action' => 'edit', $payment['Payment']['id']), array('update' => 'content', 'complete' => 'formularioAjax()', 'class' => 'acciones')) ?>
                <br>
                <br>
                <?php if ($payment['Payment']['calificacion_global']<>'Cumple')echo $this->Ajax->link('Aduntar_archivos', array('controller' => 'payments', 'action' => 'upload_files', $payment['Payment']['id']), array('update' => 'content', 'class' => 'acciones')) ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Calificar', array('controller' => 'payments', 'action' => 'qualify', $payment['Payment']['id']), array('update' => 'content', 'complete' => '', 'class' => 'acciones')) ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Ver_adjuntos', array('controller' => 'payments', 'action' => 'view', $payment['Payment']['id']), array('update' => 'content', 'complete' => '', 'class' => 'acciones')) ?>
                <br>
                <br>
                <?php echo $this->Ajax->link('Eliminar', array('controller' => 'payments', 'action' => 'delete', $payment['Payment']['id']), array('update' => 'content', 'complete' => '', 'class' => 'acciones'), '¿Desea borrar el registro?') ?>
                <br>
                <br>
                <?php echo $this->Html->link('Certificación', array('controller' => 'payments', 'action' => 'print_certification', $payment['Payment']['id']), array('target' => '_blank', 'class' => 'acciones')) ?>
                <br>
                <br>
            </td>

        </tr>

    <?php endforeach; ?>


    <tr>
        <td><b>TOTAL:</b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo "$ " . number_format($total, 2, ',', '.'); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>


    </tr>
</table>
<?php if ($res) echo $this->Ajax->link('Adicionar', array('controller' => 'payments', 'action' => 'add', $proyect_id), array('update' => 'content', 'complete' => 'formularioAjax()'), '¿Desea adiccionar  un nuevo pago?') ?>








