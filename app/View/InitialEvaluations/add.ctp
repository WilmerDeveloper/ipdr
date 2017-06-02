<?php echo $this->Form->create("InitialEvaluation", array("class" => "form", "action" => "add")); ?>
<?php echo $this->Form->input('InitialEvaluation.id', array('label' => 'id', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.calificacion_integral', array('label' => 'calificacion_integral', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
<?php echo $this->Form->input('InitialEvaluation.concepto_integral', array('label' => 'concepto_integral', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.valor_total', array('label' => 'valor_total', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.valor_total_revision', array('label' => 'valor_total_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.valor_total_calificacion', array('label' => 'valor_total_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.monto_solicitado', array('label' => 'monto_solicitado', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.monto_solicitado_calificacion', array('label' => 'monto_solicitado_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.monto_solicitado_revision', array('label' => 'monto_solicitado_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.certificadas', array('label' => 'certificadas', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.certificadas_calificacion', array('label' => 'certificadas_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.certificadas_concepto', array('label' => 'certificadas_concepto', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.contrapartidas_propias_calificacion', array('label' => 'contrapartidas_propias_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.contraprtidas_propias', array('label' => 'contraprtidas_propias', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.contrapartidas_propias_revision', array('label' => 'contrapartidas_propias_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.credito_calificacion', array('label' => 'credito_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.credito_revision', array('label' => 'credito_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.credito', array('label' => 'credito', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferir_incoder_calificacion', array('label' => 'total_transferir_incoder_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferir_incoder_revision', array('label' => 'total_transferir_incoder_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferir_incoder', array('label' => 'total_transferir_incoder', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferir_contrapartida', array('label' => 'total_transferir_contrapartida', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferir_contrapartida_calficacion', array('label' => 'total_transferir_contrapartida_calficacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferir_contrapartida_revision', array('label' => 'total_transferir_contrapartida_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferencia', array('label' => 'total_transferencia', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferencia_calificacion', array('label' => 'total_transferencia_calificacion', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
<?php echo $this->Form->input('InitialEvaluation.total_transferencia_revision', array('label' => 'total_transferencia_revision', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.verificacion_economica', array('label' => 'verificacion_economica', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
<?php echo $this->Form->input('InitialEvaluation.topes_maximos', array('label' => 'topes_maximos', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
<?php echo $this->Form->input('InitialEvaluation.evaluacion_economica', array('label' => 'evaluacion_economica', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
<?php echo $this->Form->input('InitialEvaluation.concepto_economico', array('label' => 'concepto_economico', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.riesgo', array('label' => 'riesgo', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.recomendaciones', array('label' => 'recomendaciones', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.programacion_actividades', array('label' => 'programacion_actividades', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.nombre_proyecto', array('label' => 'nombre_proyecto', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.tipo_proyecto', array('label' => 'tipo_proyecto', 'class' => '', 'empty' => '', 'options' => array('Agrícola' => 'Agrícola', 'Pecuario' => 'Pecuario', 'Agropecuario' => 'Agropecuario'))); ?>
<?php echo $this->Form->input('InitialEvaluation.tipo_poblacion', array('label' => 'tipo_poblacion', 'class' => '', 'empty' => '', 'options' => array('Campesinos' => 'Campesinos', 'Desplazados' => 'Desplazados'))); ?>
<?php echo $this->Form->input('InitialEvaluation.nombre_aliado', array('label' => 'nombre_aliado', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.objetivo', array('label' => 'Objetivo', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.origen_tema', array('label' => 'ORIGEN DEL TEMA', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.justificacion', array('label' => 'JUSTIFICACIÓN', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.descripcion_poblacion', array('label' => 'POBLACION A BENEFICIAR', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.resultados_esperados', array('label' => 'RESULTADOS ESPERADOS', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.innovacion', array('label' => 'COMPONENTES DE INNOVACION Y DESARROLLO TECNOLOGICO DEL PROYECTO', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.descripcion_personal_tecnico', array('label' => 'PERSONAL TECNICO VINCULADO', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.descripcion_solicitud', array('label' => 'SOLICITUD CONCRETA AL INCODER DEL MONTO SOLICITA PARA COFINANCIACION.', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.descripcion_valor', array('label' => 'Valor solicitado al INCODER.', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.concepto_tecnico_final', array('label' => 'concepto_tecnico_final', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.user_id', array('label' => 'user_id', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.branch_id', array('label' => 'DIRECCION TERRITORIAL PARTICIPANTE', 'class' => '')); ?>
<?php echo $this->Form->input('InitialEvaluation.proyect_id', array('label' => 'proyect_id', 'class' => '')); ?>
<?php echo $this->Form->end("Guardar") ?>
