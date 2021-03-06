<?php
/**
 * LinksController::get()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * LinksController::get()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Links\Test\Case\Controller\LinksController
 */
class LinksControllerGetTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.categories.category',
		'plugin.categories.category_order',
		'plugin.categories.categories_language',
		'plugin.links.link',
		'plugin.links.link_frame_setting',
		'plugin.links.link_order',
		'plugin.links.block_setting_for_link',
		'plugin.workflow.workflow_comment',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'links';

/**
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'links';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Links', 'TestLinks');
		//テストコントローラ生成
		$this->generateNc('TestLinks.TestControllerLinksControllerGet');
		//ログイン
		TestAuthGeneral::login($this);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);

		parent::tearDown();
	}

/**
 * get()アクションのテスト
 *
 * @return void
 */
	public function testGet() {
		//テスト実行
		$actionUrl = array(
			'plugin' => 'test_links', 'controller' => 'test_controller_links_controller_get',
			'action' => 'get', 'frame_id' => '6'
		);
		$paramUrl = 'success';

		$result = $this->_testGetAction(NetCommonsUrl::actionUrl($actionUrl) . '&url=' . $paramUrl,
				array('method' => 'assertNotEmpty'), null, 'json');

		//チェック
		$this->assertEquals('OK', $result['name']);
		$this->assertEquals(200, $result['code']);
		$this->assertNotEmpty($result['title']);
		$this->assertNotEmpty($result['description']);
	}

/**
 * get()アクションのテスト(URLが空値)
 *
 * @return void
 */
	public function testGetWOUrl() {
		//テスト実行
		$actionUrl = array(
			'plugin' => 'test_links', 'controller' => 'test_controller_links_controller_get',
			'action' => 'get', 'frame_id' => '6'
		);
		$paramUrl = '';

		$result = $this->_testGetAction(NetCommonsUrl::actionUrl($actionUrl) . '&url=' . $paramUrl,
				null, 'BadRequestException', 'json');

		//チェック
		$this->assertEquals('Bad Request', $result['name']);
		$this->assertEquals(sprintf(__d('net_commons', 'Please input %s.'), __d('links', 'URL')), $result['error']);
	}

/**
 * get()アクションのテスト(URLが不正)
 *
 * @return void
 */
	public function testGetOnBadUrl() {
		//テスト実行
		$actionUrl = array(
			'plugin' => 'test_links', 'controller' => 'test_controller_links_controller_get',
			'action' => 'get', 'frame_id' => '6'
		);
		$paramUrl = 'failure';

		$result = $this->_testGetAction(NetCommonsUrl::actionUrl($actionUrl) . '&url=' . $paramUrl,
				null, 'BadRequestException', 'json');

		//チェック
		$this->assertEquals('Bad Request', $result['name']);
		$this->assertEquals(__d('links', 'Failed to obtain the title for this page.'), $result['error']);
	}

}
