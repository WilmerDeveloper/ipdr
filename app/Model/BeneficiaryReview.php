<?php 
class BeneficiaryReview extends AppModel {

	public $name="BeneficiaryReview";
	public $belongsTo=array('Beneficiary', 'User');
        public $actsAs = array('Logable' => array(
            'userModel' => 'User',
            'userKey' => 'user_id',
            'change' => 'full', // options are 'list' or 'full'
            'description_ids' => TRUE // options are TRUE or FALSE
            ));

} 
 ?>