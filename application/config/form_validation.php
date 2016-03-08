<?php if(! defined('BASEPATH')) exit('No direct script allowed');

$config = array(
		'airport_put' => array(
		array('field'=>'airport_code','label'=>'Airport Code','rules'=>'trim|required'),
		array('field'=>'airport_name','label'=>'Airport Nane','rules'=>'trim|required'),
		array('field'=>'country','label'=>'Country','rules'=>'trim|required'),
		array('field'=>'city','label'=>'City','rules'=>'trim|required'),
		array('field'=>'user_id','label'=>'User Id','rules'=>'trim|required'),
		),
		'airport_post' => array(
		array('field'=>'airport_code','label'=>'Airport Code','rules'=>'trim|required'),
		array('field'=>'airport_name','label'=>'Airport Nane','rules'=>'trim|required'),
		array('field'=>'country','label'=>'Country','rules'=>'trim|required'),
		array('field'=>'city','label'=>'City','rules'=>'trim|required'),
		array('field'=>'user_id','label'=>'User Id','rules'=>'trim|required'),
		),
		
);


?>