
<?php echo $this->Form->create("Payment"); ?>
<table border="1">
    <tbody>
        <tr>
            <td>Valor</td>
            <td><?php echo "$ " . number_format($this->data['Payment']['valor_desembolsado'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Poliza</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poliza']) and $this->data['Payment']['adjunto_poliza'] != "") {


                    echo $this->Html->link('Ver_póliza ', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poliza'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargada la póliza";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Póliza calificación</td>
            <td>
                <?php echo $this->Form->hidden('Payment.id') ?>
                <?php echo $this->Form->hidden('Payment.adjuntador') ?>
                <?php echo $this->Form->hidden('Proyect.codigo') ?>
                <?php echo $this->Form->input('Payment.calificacion_poliza', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Póliza observación</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_poliza', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr>
            <td>Aprobación de la Póliza</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_aprobacion']) and $this->data['Payment']['adjunto_aprobacion'] != "") {

                    echo $this->Html->link('Aprobación_poliza', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_aprobacion'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargada la probación de la  póliza";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Aprobación de la Póliza calificación</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_aprobacion', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Aprobación de la Póliza observación</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_aprobacion', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr>
            <td>Certificación bancaria</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_bancaria']) and $this->data['Payment']['adjunto_bancaria'] != "") {

                    echo $this->Html->link('Certificación_bancaria ', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_bancaria'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargada la Certificación_bancaria";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>calificación Certificación bancaria</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_bancaria', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Observaciones Certificación bancaria</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_bancaria', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr> 
            <td>Formato Notificación</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_notificacion']) and $this->data['Payment']['adjunto_notificacion'] != "") {

                    echo $this->Html->link('Formato Notificación ', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_notificacion'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargada Formato Notificación";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Calificaión Formato Notificación</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_notificacion', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Observaciones Formato Notificación</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_notificacion', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr> 
            <td>Poder</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poder']) and $this->data['Payment']['adjunto_poder'] != "") {

                    echo $this->Html->link('Poder', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_poder'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargada Formato Notificación";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Calificaión Poder</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_poder', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Observaciones Poder</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_poder', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr> 
            <td>Componente sanitario</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_sanitario']) and $this->data['Payment']['adjunto_sanitario'] != "") {

                    echo $this->Html->link('Componente_sanitario', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_sanitario'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargado Componente_sanitario";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Calificaión Componente sanitario</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_sanitario', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Observaciones Componente sanitario</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_sanitario', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr> 
            <td>Distrito de riego</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_distrito']) and $this->data['Payment']['adjunto_distrito'] != "") {

                    echo $this->Html->link('Distrito_riego', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_distrito'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargado Distrito de riego";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Calificaión Distrito de riego</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_riego', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Observaciones Distrito de riego</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_riego', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr> 
            <td>Revisión equipo técnico</td>
            <td>
                <?php
                if (file_exists("../webroot/files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_tecnico']) and $this->data['Payment']['adjunto_tecnico'] != "") {

                    echo $this->Html->link('Revisión_equipo_técnico', "../files/" . $this->data['Payment']['proyect_id'] . "-" . $this->data['Proyect']['codigo'] . "/" . $this->data['Payment']['adjunto_tecnico'], array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones'));
                } else {
                    echo "No ha sido cargado Revisión_equipo_técnico";
                }
                ?>

            </td>
        </tr>
        <tr>
            <td>Revisión equipo técnico</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_tecnico', array('label' => '', 'options' => array('empty' => 'No aplica', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>
            </td>
        </tr>
        <tr>
            <td>Revisión equipo técnico</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_tecnico', array('label' => '', 'class' => 'txtarea', 'title' => '')) ?>
            </td>
        </tr>
        <tr>
            <td>Observaciones</td>
            <td>
                <?php echo $this->Form->input('Payment.observacion_global', array('label' => '')) ?>

            </td>
        </tr>
        <tr>
            <td>Calificación global</td>
            <td>
                <?php echo $this->Form->input('Payment.calificacion_global', array('label' => '', 'options' => array('empty' => '', 'Cumple' => 'Cumple', 'No cumple' => 'No cumple'))) ?>

            </td>
        </tr>

    </tbody>
</table>

<?php
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Payments', 'action' => 'qualify', $this->data["Payment"]["id"]), 'update' => 'content', 'indicator' => 'loading'));
echo $this->Form->end();
?>
<br><br>
<br>
<?php
echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'regresar')), array('controller' => 'payments', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false));
?>
<br>   