<?php
/**
 * LinkFrameSettingsController Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('LinksAppController', 'Links.Controller');

/**
 * LinkFrameSettingsController Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Links\Controller
 */
class LinkFrameSettingsController extends LinksAppController {

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'Links.LinkFrameSetting'
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsFrame',
		'NetCommons.NetCommonsRoomRole' => array(
			//コンテンツの権限設定
			'allowedActions' => array(
				'pageEditable' => array('edit')
			),
		),
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->layout = 'NetCommons.setting';
		$results = $this->camelizeKeyRecursive($this->NetCommonsFrame->data);
		$this->set($results);

		//タブの設定
		$this->initTabs('frame_settings', '');
	}

/**
 * edit
 *
 * @return void
 */
	public function edit() {
		if (! $this->NetCommonsFrame->validateFrameId()) {
			$this->throwBadRequest();
			return false;
		}
		if (! $linkFrameSetting = $this->LinkFrameSetting->getLinkFrameSetting($this->viewVars['frameKey'])) {
			$linkFrameSetting = $this->LinkFrameSetting->create(array(
				'id' => null,
				'display_type' => LinkFrameSetting::TYPE_DROPDOWN,
				'frame_key' => $this->viewVars['frameKey'],
				'category_separator_line' => null,
				'list_style' => null,
			));
		}
		$linkFrameSetting = $this->camelizeKeyRecursive($linkFrameSetting);

		$data = array();
		if ($this->request->isPost()) {
			$data = $this->data;
			$this->LinkFrameSetting->saveLinkFrameSetting($data);
			if ($this->handleValidationError($this->LinkFrameSetting->validationErrors)) {
				if (! $this->request->is('ajax')) {
					$this->redirect('/' . $this->viewVars['cancelUrl']);
				}
				return;
			}
		}

		$data = Hash::merge(
			$linkFrameSetting, $data
		);
		$results = $this->camelizeKeyRecursive($data);
		$this->set($results);
	}
}