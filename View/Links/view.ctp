<?php
/**
 * リンク詳細
 * 新着・検索等で使用する
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
	$this->NetCommonsHtml->url('/links/links/link.json'),
	$tokenFields,
	$hiddenFields
);

echo $this->NetCommonsHtml->css('/links/css/style.css');
echo $this->NetCommonsHtml->script('/links/js/links.js');
?>

<article class="nc-content-list" ng-controller="LinksIndex"
		ng-init="initialize(<?php echo h(json_encode(Hash::merge($this->request->data, $tokens))); ?>)">

	<?php if ($this->Workflow->canEdit('Links.Link', $link)) : ?>
		<header class="clearfix">
			<div class="pull-left">
				<?php echo $this->LinkButton->toList(); ?>
			</div>
			<div class="pull-right">
				<?php echo $this->LinkButton->edit('', array('key' => $link['Link']['key'])); ?>
			</div>
		</header>
	<?php endif; ?>

	<h1>
		<?php echo $this->Workflow->label($link['Link']['status']) .
				trim($this->element('Links.Links/link', array('link' => $link))); ?>
	</h1>

	<div class="clearfix text-muted link-view-info">
		<?php if (Hash::get($category, 'name')) : ?>
			<div class="pull-left link-view-category">
				<?php echo __d('categories', 'Category'); ?>:
				<?php echo h(Hash::get($category, 'name')); ?>
			</div>
		<?php endif; ?>

		<div class="pull-left link-view-created">
			<?php echo __d('net_commons', 'Created:'); ?>
			<?php echo $this->NetCommonsHtml->handleLink($link, ['avatar' => true], [], 'TrackableCreator'); ?>
			<span class="link-view-created-datetime">
				(<?php echo $this->NetCommonsHtml->dateFormat(Hash::get($link, 'Link.created')); ?>)
			</span>
		</div>

		<div class="pull-left link-view-modified">
			<?php echo __d('net_commons', 'Modified:'); ?>
			<?php echo $this->NetCommonsHtml->handleLink($link, ['avatar' => true], [], 'TrackableUpdater'); ?>
			<span class="link-view-created-datetime">
				(<?php echo $this->NetCommonsHtml->dateFormat(Hash::get($link, 'Link.modified')); ?>)
			</span>
		</div>
	</div>

	<article>
		<?php echo h(nl2br(Hash::get($link, 'Link.description'))); ?>
	</article>
</article>
