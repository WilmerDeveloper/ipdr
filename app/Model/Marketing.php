<?php 
class Marketing extends AppModel {

	public $name="Marketing";
	public $belongsTo=array('ProductiveBaseline','ProductiveActivity',);
         public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>