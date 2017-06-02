<?php

class Proyect extends AppModel {

    public $name = "Proyect";
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
    ));
    public $belongsTo = array('City', 'Departament');
    public $hasMany = array('Property', 'InitialEvaluation', 'Follow', 
        'Committee', 'FollowProduct', 'Visit', 'Advice', 'Payment', 'Product', 'Extract', 'FinalReport');

}

?>