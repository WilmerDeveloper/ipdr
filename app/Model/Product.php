<?php

class Product extends AppModel {

    public $name = "Product";
    public $belongsTo = array('Visit', 'ProductType');
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>