<div class="partNos index">
	<h2><?php __('Part Nos');?></h2>
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
	foreach ($partNos as $partNo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $partNo['PartNo']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($partNo['Department']['name'], array('controller' => 'departments', 'action' => 'view', $partNo['Department']['code'])); ?>
		</td>
		<td><?php echo $partNo['PartNo']['name']; ?>&nbsp;</td>
		<td><?php echo $partNo['PartNo']['created']; ?>&nbsp;</td>
		<td><?php echo $partNo['PartNo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $partNo['PartNo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $partNo['PartNo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $partNo['PartNo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $partNo['PartNo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Part No', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>