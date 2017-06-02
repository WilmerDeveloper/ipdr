<?php

if (!empty($cities)) {
    echo $this->Form->input('Candidate.city_id', array(
        
        'label' => __('Ciudad', true),
        'empty' => __('Seleccione ciudad', true),
        'class' => 'required'
            )
    );
}
?>
