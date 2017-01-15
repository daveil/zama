<div class="modelNos index">
	<h2><?php __('Model Nos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('department_id');?></th>
			<th><?php echo $this->Paginator->sort('category_id');?></th>
			<th><?php echo $this->Paginator->sort('kpi_id');?></th>
			<th><?php echo $this->Paginator->sort('subcategory_id');?></th>
			<th><?php echo $this->Paginator->sort('line_machine_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($modelNos as $modelNo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $modelNo['ModelNo']['id']; ?>&nbsp;</td>
		<td><?php echo $modelNo['ModelNo']['department_id']; ?>&nbsp;</td>
		<td><?php echo $modelNo['ModelNo']['category_id']; ?>&nbsp;</td>
		<td><?php echo $modelNo['ModelNo']['kpi_id']; ?>&nbsp;</td>
		<td><?php echo $modelNo['ModelNo']['subcategory_id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($modelNo['LineMachine']['name'], array('controller' => 'line_machines', 'action' => 'view', $modelNo['LineMachine']['id'])); ?>
		</td>
		<td><?php echo $modelNo['ModelNo']['name']; ?>&nbsp;</td>
		<td><?php echo $modelNo['ModelNo']['created']; ?>&nbsp;</td>
		<td><?php echo $modelNo['ModelNo']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $modelNo['ModelNo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $modelNo['ModelNo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $modelNo['ModelNo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modelNo['ModelNo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Model No', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
	</ul>
</div>