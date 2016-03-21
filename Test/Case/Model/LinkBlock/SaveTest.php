<?php
/**
 * beforeSave()とafterSave()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsSaveTest', 'NetCommons.TestSuite');
App::uses('LinkBlockFixture', 'Links.Test/Fixture');
App::uses('LinkSettingFixture', 'Links.Test/Fixture');

/**
 * beforeSave()とafterSave()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Links\Test\Case\Model\LinkBlock
 */
class LinkBlockSaveTest extends NetCommonsSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.categories.category',
		'plugin.categories.category_order',
		'plugin.links.link',
		'plugin.links.link_frame_setting',
		'plugin.links.link_order',
		'plugin.links.link_setting',
		'plugin.workflow.workflow_comment',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'links';

/**
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'LinkBlock';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'save';

/**
 * Save用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array テストデータ
 */
	public function dataProviderSave() {
		//データ生成
		$data['LinkBlock'] = (new LinkBlockFixture())->records[0];
		$data['LinkSetting'] = (new LinkSettingFixture())->records[0];
		$data['Frame'] = array('id' => '6');
		$data['Block'] = array(
			'id' => $data['LinkBlock']['id'],
			'key' => $data['LinkBlock']['key'],
		);

		$results = array();
		// * 編集の登録処理
		$results[0] = array($data);
		// * 新規の登録処理
		$results[1] = array($data);
		$results[1] = Hash::insert($results[1], '0.LinkBlock.id', null);
		$results[1] = Hash::insert($results[1], '0.LinkBlock.key', null);
		$results[1] = Hash::remove($results[1], '0.LinkBlock.created_user');
		$results[1] = Hash::insert($results[1], '0.LinkSetting.id', null);
		$results[1] = Hash::insert($results[1], '0.LinkSetting.block_key', '');
		$results[1] = Hash::remove($results[1], '0.LinkSetting.created_user');
		$results[1] = Hash::insert($results[1], '0.Block.id', null);
		$results[1] = Hash::insert($results[1], '0.Block.key', null);

		return $results;
	}

/**
 * Saveのテスト
 *
 * @param array $data 登録データ
 * @dataProvider dataProviderSave
 * @return void
 */
	public function testSave($data) {
		$model = $this->_modelName;
		$method = $this->_methodName;
		$alias = $this->$model->LinkSetting->alias;

		//チェック用データ取得
		if (isset($data[$alias]['id'])) {
			$before = $this->$model->LinkSetting->find('first', array(
				'recursive' => -1,
				'conditions' => array('id' => $data[$alias]['id']),
			));
		}

		//テスト実行
		$result = $this->$model->$method($data);
		$this->assertNotEmpty($result);

		//idのチェック
		if (isset($data[$alias]['id'])) {
			$id = $data[$alias]['id'];
		} else {
			$id = $this->$model->LinkSetting->getLastInsertID();
		}

		//登録データ取得
		$actual = $this->$model->LinkSetting->find('first', array(
			'recursive' => -1,
			'conditions' => array('id' => $id),
		));
		$actual[$alias] = Hash::remove($actual[$alias], 'modified');
		$actual[$alias] = Hash::remove($actual[$alias], 'modified_user');

		if (! isset($data[$alias]['id'])) {
			$actual[$alias] = Hash::remove($actual[$alias], 'created');
			$actual[$alias] = Hash::remove($actual[$alias], 'created_user');

			$data[$alias]['block_key'] = OriginalKeyBehavior::generateKey('Block', $this->$model->useDbConfig);
			$before[$alias] = array();
		}
		$expected[$alias] = Hash::merge(
			$before[$alias],
			$data[$alias],
			array(
				'id' => $id,
			)
		);
		$expected[$alias] = Hash::remove($expected[$alias], 'modified');
		$expected[$alias] = Hash::remove($expected[$alias], 'modified_user');

		$this->assertEquals($expected, $actual);
	}

/**
 * SaveのExceptionError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド
 *
 * @return array テストデータ
 */
	public function dataProviderSaveOnExceptionError() {
		$data = $this->dataProviderSave()[0][0];

		return array(
			array($data, 'Links.LinkSetting', 'save'),
		);
	}

/**
 * SaveのValidationError用DataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド(省略可：デフォルト validates)
 *
 * @return array テストデータ
 */
	public function dataProviderSaveOnValidationError() {
		$data = $this->dataProviderSave()[0][0];

		return array(
			array($data, 'Links.LinkSetting'),
		);
	}

}