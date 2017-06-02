<?php echo $this->Form->create("Requirement", array("class" => "form", "action" => "edit")); ?>
<?php echo $this->Form->hidden('Requirement.id'); ?>
<?php echo $this->Form->input('Requirement.call_id', array('label' => 'Convocatoria', 'class' => 'required', 'empty' => '')); ?>
<?php echo $this->Form->input('Requirement.nombre', array('label' => 'Requisito', 'class' => 'required')); ?>
<?php echo $this->Form->input('Requirement.texto_ayuda', array('label' => 'Texto de ayuda')); ?>
<?php echo $this->Form->input('Requirement.puntaje_maximo', array('label' => 'Puntaje maximo', 'class' => '', 'type' => 'number')); ?>
<?php echo $this->Form->input('Requirement.tipo', array('label' => 'Tipo', 'options' => array('empty' => '', 'General' => 'General', 'Caracterización' => 'Caracterización', 'Formulación' => 'Formulación', 'Criterios técnicos' => 'Criterios técnicos', 'Análisis financiero' => 'Análisis financiero', 'Componente ambiental' => 'Componente ambiental', 'Verificación económica' => 'Verificación económica', 'Asumidos contrapartida' => 'Asumidos contrapartida', 'Aclaración social' => 'Aclaración social', 'Aclaración técnica' => 'Aclaración técnica', 'Aclaración financiera' => 'Aclaración financiera', 'Aclaración ambiental' => 'Aclaración ambiental', 'Rubros no financiables' => 'Rubros no financiables', 'Gastos contrapartida' => 'Gastos contrapartida','OBJETIVOS-ACTIVIDADES Y METAS'=>'OBJETIVOS-ACTIVIDADES Y METAS','Componente social'=>'Componente social','Componente comercial'=>'Componente comercial','Componente comercial'=>'Componente comercial','Seguridad alimentaria'=>'Seguridad alimentaria'))); ?>

<?php echo $this->Form->end("Guardar") ?>
