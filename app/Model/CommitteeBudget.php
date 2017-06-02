<?php 
class CommitteeBudget extends AppModel {

	public $name="CommitteeBudget";
	public $belongsTo=array('Committee','Budget',);

} 
 ?>