<?php

class WaterResource extends AppModel {

    public $name = "WaterResource";
    //public $belongsTo=array('Property');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>
