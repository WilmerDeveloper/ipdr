<?php 
class ProductiveBaseline extends AppModel {

	public $name="ProductiveBaseline";
	public $belongsTo=array('Property','User');
         public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>