<?php 
class BeekeepingInventory extends AppModel {

	public $name="BeekeepingInventory";
	public $belongsTo=array('ProductiveBaseline',);
         public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>