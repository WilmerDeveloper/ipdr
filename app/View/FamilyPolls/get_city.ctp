<?php

if ($tipo==1) {
    echo $this->Form->input('FamilyPoll.city_id', array(
        
        'label' => __('Municipio', true),
        'empty' => __('Seleccione ciudad', true),
        'class' => 'required'
            )
    );
}else{
     echo $this->Form->input('FamilyPoll.ciudad_desplazamiento', array(
        
        'label' => __('Municipio', true),
        'empty' => __('Seleccione ciudad', true),
        'class' => 'required',
         'options'=>$cities
            )
    );
}

?>
