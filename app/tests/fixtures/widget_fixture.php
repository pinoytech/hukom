<?php
/* Widget Fixture generated on: 2011-01-13 04:01:56 : 1294864136 */
class WidgetFixture extends CakeTestFixture {
	var $name = 'Widget';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'part_no' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 12, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'quantity' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'part_no' => 'Lorem ipsu',
			'quantity' => 1
		),
	);
}
?>