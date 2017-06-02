<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productive_activities
 *
 * @author wilavel
 */
class ProductType extends AppModel {

    //put your code here
    public $name = "ProductType";
    public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
    public $hasMany = array('Product');

}

?>
