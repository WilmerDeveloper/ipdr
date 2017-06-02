<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of beneficiary
 *
 * @author 250-1-405
 */
class Beneficiary extends AppModel {

    //put your code here
    var $name = "Beneficiary";
    var $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));
    var $belongsTo = array(
        'Property' => array(
            'model' => 'Proyect'
        )
    );
    var $hasMany = array(
        'Family' => array(
            'model' => 'Family',
        ),
        'BeneficiaryRequirement' => array(
            'model' => 'BeneficiaryRequirement',
        ),
        
    );

}

?>
