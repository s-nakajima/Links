<?php
/**
 * LinkOrderFixture
 *
* @author   Jun Nishikawa <topaz2@m0n0m0n0.com>
* @link     http://www.netcommons.org NetCommons Project
* @license  http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for LinkOrderFixture
 */
class LinkOrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'link_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'link key | リンクKey | links.key | ', 'charset' => 'utf8'),
		'link_category_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'category key | カテゴリーKey | link_categories.key | ', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'The weight of the display(display order) | 表示の重み(表示順序) |  | '),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created datetime | 作成日時 |  | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified datetime | 更新日時 |  | '),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'link_key' => 'key1',
			'link_category_key' => 'Lorem ipsum dolor sit amet',
			'weight' => 10,
			'created_user' => 1,
			'created' => '2014-10-25 04:56:40',
			'modified_user' => 1,
			'modified' => '2014-10-25 04:56:40'
		),
		array(
			'id' => 2,
			'link_key' => 'key2',
			'link_category_key' => 'Lorem ipsum dolor sit amet',
			'weight' => 1,
			'created_user' => 1,
			'created' => '2014-10-25 04:56:40',
			'modified_user' => 1,
			'modified' => '2014-10-25 04:56:40'
		),
		array(
			'id' => 3,
			'link_key' => 'key3',
			'link_category_key' => 'Lorem ipsum dolor sit amet',
			'weight' => 5,
			'created_user' => 1,
			'created' => '2014-10-25 04:56:40',
			'modified_user' => 1,
			'modified' => '2014-10-25 04:56:40'
		),
	);

}
