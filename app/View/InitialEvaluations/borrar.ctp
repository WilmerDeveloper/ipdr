<?php echo $this->Form->input('InitialEvaluation.recomendaciones',array('label'=>'Recomendaciones (Por favor diligenciar según su evaluación)','class' =>''    ));?>
<?php echo $this->Form->input('InitialEvaluation.programacion_actividades',array('label'=>'programacion_actividades','class' =>''    ));?>
<?php echo $this->Form->input('InitialEvaluation.nombre_proyecto',array('label'=>'nombre_proyecto','class' =>''    ));?>
<?php echo $this->Form->input('InitialEvaluation.tipo_proyecto',array('label'=>'tipo_proyecto','class' =>''   ,'empty'=>'','options'=>array('Agrícola' => 'Agrícola','Pecuario' => 'Pecuario','Agropecuario'=>'Agropecuario') ));?>
<?php echo $this->Form->input('InitialEvaluation.tipo_poblacion',array('label'=>'tipo_poblacion','class' =>''   ,'empty'=>'','options'=>array('Campesinos' => 'Campesinos','Desplazados'=>'Desplazados') ));?>
<?php echo $this->Form->input('InitialEvaluation.proyect_id',array('label'=>'proyect_id','class' =>''    ));?>
<?php echo $this->Form->input('InitialEvaluation.user_id',array('label'=>'user_id','class' =>''    ));?>
<?php echo $this->Form->end("Guardar")?>
