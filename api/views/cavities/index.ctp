<div class="cavities index">
	<h2><?php __('Cavities');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('department_code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cavities as $cavity):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $cavity['Cavity']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cavity['Department']['name'], array('controller' => 'departments', 'action' => 'view', $cavity['Department']['code'])); ?>
		</td>
		<td><?php echo $cavity['Cavity']['name']; ?>&nbsp;</td>
		<td><?php echo $cavity['Cavity']['created']; ?>&nbsp;</td>
		<td><?php echo $cavity['Cavity']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $cavity['Cavity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $cavity['Cavity']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $cavity['Cavity']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $cavity['Cavity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Cavity', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>