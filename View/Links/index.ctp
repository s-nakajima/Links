<?php
/**
 * リンク一覧
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

$this->request->data = array(
	'Frame' => array(
		'id' => Current::read('Frame.id')
	),
	'Block' => array(
		'id' => Current::read('Block.id')
	),
	'Link' => array(
		'id' => null,
		'key' => null,
	),
);
$tokenFields = Hash::flatten($this->request->data);
$hiddenFields = array('Frame.id', 'Block.id');

$this->Token->unlockField('Link.id');
$tokens = $this->Token->getToken('Link',
	'/links/links/link.json',
	$tokenFields,
	$hiddenFields
);

echo $this->NetCommonsHtml->css('/links/css/style.css');
echo $this->NetCommonsHtml->script('/links/js/links.js');

$displayType = $linkFrameSetting['display_type'];
?>

<div class="nc-content-list" ng-controller="LinksIndex"
	 ng-init="initialize(<?php echo h(json_encode(Hash::merge($this->request->data, $tokens))); ?>)">

		<?php if ($displayType !== LinkFrameSetting::TYPE_DROPDOWN) : ?>
			<?php echo $this->NetCommonsHtml->blockTitle($linkBlock['name']); ?>
		<?php endif; ?>

		<header class="text-right">
			<?php if (Current::permission('content_editable') && $links) : ?>
				<?php echo $this->LinkButton->sort('',
						NetCommonsUrl::blockUrl(array('controller' => 'link_orders', 'action' => 'edit'))
					); ?>
			<?php endif; ?>

			<?php echo $this->Workflow->addLinkButton('', null, array('tooltip' => __d('links', 'Create link'))); ?>
		</header>

		<?php
			if ($displayType === LinkFrameSetting::TYPE_DROPDOWN) {
				echo $this->element('Links/index_dropdown');

			} elseif ($displayType === LinkFrameSetting::TYPE_LIST_ONLY_TITLE) {
				if ($links) {
					echo $this->element('Links/index_list_only_title');
				} else {
					echo '<article>' . __d('links', 'No link found.') . '</article>';
				}

			} elseif ($displayType === LinkFrameSetting::TYPE_LIST_WITH_DESCRIPTION) {
				if ($links) {
					echo $this->element('Links/index_list_with_description');
				} else {
					echo '<article>' . __d('links', 'No link found.') . '</article>';
				}
			}
		?>
</div>
