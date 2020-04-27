<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {
	var $validate = array(
		'imie' => array('rule' => 'notBlank'),
		'nazwisko' => array('rule' => 'notBlank'),
		'placa_pod' => array('rule' => array('range', -0.0000001, 2000.0000001),),
	);
}
