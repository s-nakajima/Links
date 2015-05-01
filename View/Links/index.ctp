<div class="links index">
	<h2><?php echo __('Links'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('block_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('key'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('click_count'); ?></th>
			<th><?php echo $this->Paginator->sort('created_user'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_user'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($links as $link): ?>
	<tr>
		<td><?php echo h($link['Link']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($link['Block']['name'], array('controller' => 'blocks', 'action' => 'view', $link['Block']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($link['Category']['name'], array('controller' => 'categories', 'action' => 'view', $link['Category']['id'])); ?>
		</td>
		<td><?php echo h($link['Link']['key']); ?>&nbsp;</td>
		<td><?php echo h($link['Link']['status']); ?>&nbsp;</td>
		<td><?php echo h($link['Link']['url']); ?>&nbsp;</td>
		<td><?php echo h($link['Link']['title']); ?>&nbsp;</td>
		<td><?php echo h($link['Link']['description']); ?>&nbsp;</td>
		<td><?php echo h($link['Link']['click_count']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($link['TrackableCreator']['id'], array('controller' => 'users', 'action' => 'view', $link['TrackableCreator']['id'])); ?>
		</td>
		<td><?php echo h($link['Link']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($link['TrackableUpdater']['id'], array('controller' => 'users', 'action' => 'view', $link['TrackableUpdater']['id'])); ?>
		</td>
		<td><?php echo h($link['Link']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $link['Link']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $link['Link']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $link['Link']['id']), null, __('Are you sure you want to delete # %s?', $link['Link']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Link'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trackable Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
