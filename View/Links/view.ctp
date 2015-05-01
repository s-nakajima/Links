<div class="links view">
<h2><?php echo __('Link'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($link['Link']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block'); ?></dt>
		<dd>
			<?php echo $this->Html->link($link['Block']['name'], array('controller' => 'blocks', 'action' => 'view', $link['Block']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($link['Category']['name'], array('controller' => 'categories', 'action' => 'view', $link['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($link['Link']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($link['Link']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($link['Link']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($link['Link']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($link['Link']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Click Count'); ?></dt>
		<dd>
			<?php echo h($link['Link']['click_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($link['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $link['TrackableCreator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($link['Link']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trackable Updater'); ?></dt>
		<dd>
			<?php echo $this->Html->link($link['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $link['TrackableUpdater']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($link['Link']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Link'), array('action' => 'edit', $link['Link']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Link'), array('action' => 'delete', $link['Link']['id']), null, __('Are you sure you want to delete # %s?', $link['Link']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Links'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Link'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
