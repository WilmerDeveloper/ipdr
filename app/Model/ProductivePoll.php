<?php

class ProductivePoll extends AppModel {

    public $name = "ProductivePoll";
    public $belongsTo = array('Family',);
    public $hasMany = array('Certification', 'Consumption', 'Lender', 'MarketingLine', 'Practice', 'ProductiveArea', 'ProductiveProblem', 'Transformation', 'Wrapper',);
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

}

?>