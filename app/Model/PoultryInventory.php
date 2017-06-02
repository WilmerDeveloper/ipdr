<?php 
class PoultryInventory extends AppModel {

	public $name="PoultryInventory";
	public $belongsTo=array('ProductiveBaseline',);
         public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>