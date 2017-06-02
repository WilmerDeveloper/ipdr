<?php 
class ProductiveProblem extends AppModel {

	public $name="ProductiveProblem";
	public $belongsTo=array('ProductivePoll',);
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>