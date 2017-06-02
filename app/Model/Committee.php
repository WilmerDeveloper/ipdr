<?php 
class Committee extends AppModel {

	public $name="Committee";
	public $belongsTo=array('Proyect');
	public $hasMany=array('CommitteeBudget');

} 
 ?>