<?php
/**
 * Link edit template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

?>

<?php echo $this->Form->hidden('LinkFrameSetting.id', array(
		'value' => isset($linkFrameSetting['id']) ? (int)$linkFrameSetting['id'] : null,
	)); ?>

<?php echo $this->Form->hidden('LinkFrameSetting.frame_key', array(
		'value' => $frameKey,
	)); ?>

<?php echo $this->Form->hidden('Frame.id', array(
		'value' => $frameId,
	)); ?>

<?php echo $this->Form->hidden('Frame.key', array(
		'value' => $frameKey,
	)); ?>

<div class='form-group'>
	<?php echo $this->Form->input('LinkFrameSetting.display_type', array(
			'label' => __d('links', 'Display method'),
			'type' => 'select',
			'error' => false,
			'class' => 'form-control',
			'options' => array(
				LinkFrameSetting::TYPE_DROPDOWN => __d('links', 'Show by dropdown'),
				LinkFrameSetting::TYPE_LIST_ONLY_TITLE => __d('links', 'Show list'),
				LinkFrameSetting::TYPE_LIST_WITH_DESCRIPTION => __d('links', 'Show list (Description)'),
			),
			'value' => (isset($linkFrameSetting['displayType']) ? $linkFrameSetting['displayType'] : LinkFrameSetting::TYPE_DROPDOWN)
		)); ?>
</div>

<div class='form-group'>
	<?php echo $this->Form->input('LinkFrameSetting.open_new_tab', array(
			'label' => __d('links', 'Open as a new tab'),
			'type' => 'checkbox',
			'error' => false,
			'checked' => (isset($linkFrameSetting['openNewTab']) ? (int)$linkFrameSetting['openNewTab'] : null)
		)); ?>
</div>

<div class='form-group'>
	<?php echo $this->Form->input('LinkFrameSetting.display_click_count', array(
			'label' => __d('links', 'Count view'),
			'type' => 'checkbox',
			'error' => false,
			'checked' => (isset($linkFrameSetting['displayClickCount']) ? (int)$linkFrameSetting['displayClickCount'] : null)
		)); ?>
</div>

<div class='form-group'>
	<?php echo $this->Form->label('LinkFrameSetting.category_separator_line',
			__d('links', 'Line')
		); ?>

	<?php echo $this->Form->hidden('LinkFrameSetting.category_separator_line', array(
			'ng-value' => 'linkFrameSetting.categorySeparatorLine'
		)); ?>
	<?php $this->Form->unlockField('LinkFrameSetting.category_separator_line'); ?>

	<div class="btn-group nc-input-dropdown">
		<button type="button" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
			<div class="clearfix">
				<div class="pull-left">
					<span ng-if="currentCategorySeparatorLine.name">
						{{currentCategorySeparatorLine.name}}
					</span>
					<hr class="nc-links-edit-line" ng-if="(currentCategorySeparatorLine.style !== null)"
						style="{{currentCategorySeparatorLine.style}}" ng-cloak>
				</div>
				<div class="pull-right">
					<span class="caret"> </span>
				</div>
			</div>
		</button>

		<ul class="dropdown-menu text-left" role="menu"
			ng-init="categorySeparatorLines = <?php echo h(json_encode(LinkFrameSetting::$categorySeparators)); ?>">

			<li ng-repeat="line in categorySeparatorLines track by $index" ng-class="{active: (line.key===currentCategorySeparatorLine.key)}">
				<a class="text-left" href="" ng-click="selectCategorySeparatorLine(line)">
					<span ng-if="line.name">
						{{line.name}}
					</span>
					<hr class="nc-links-edit-line" ng-if="(line.style !== null)" style="{{line.style}}">
				</a>
			</li>
		</ul>
	</div>
</div>

<div class='form-group'>
	<?php echo $this->Form->label('LinkFrameSetting.list_style',
			__d('links', 'Marker')
		); ?>
	<?php echo $this->Form->hidden('LinkFrameSetting.list_style', array(
			'ng-value' => 'linkFrameSetting.listStyle'
		)); ?>
	<?php $this->Form->unlockField('LinkFrameSetting.list_style'); ?>

	<div class="btn-group nc-input-dropdown">
		<button type="button" class="dropdown-toggle btn btn-default" data-toggle="dropdown" aria-expanded="false">
			<div class="clearfix">
				<div class="pull-left">
					<span ng-if="currentListStyle.name">
						{{currentListStyle.name}}
					</span>
					<ul ng-if="currentListStyle.style" class="nc-links-edit-mark">
						<li style="{{currentListStyle.style}}" ng-cloak>
							<?php echo __d('links', 'Sample'); ?>
						</li>
					</ul>
				</div>
				<div class="pull-right">
					<span class="caret"> </span>
				</div>
			</div>
		</button>

		<ul class="dropdown-menu" role="menu"
			ng-init="listStyles = <?php echo h(json_encode(LinkFrameSetting::$listStyles)); ?>">

			<li ng-repeat="mark in listStyles track by $index" ng-class="{active: (mark.key===currentListStyle.key)}" ng-cloak>
				<a href="" ng-click="selectListStyle(mark)">
					<span ng-if="mark.name">
						{{mark.name}}
					</span>
					<ul ng-if="mark.style" class="nc-links-edit-mark">
						<li style="{{mark.style}}" ng-cloak>
							<?php echo __d('links', 'Sample'); ?>
						</li>
					</ul>
				</a>
			</li>
		</ul>
	</div>
</div>