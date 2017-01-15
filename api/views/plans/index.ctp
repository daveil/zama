<div class="plans index">
	<h2><?php __('Plans');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('line_machine_id');?></th>
			<th><?php echo $this->Paginator->sort('shift_day');?></th>
			<th><?php echo $this->Paginator->sort('shift_night');?></th>
			<th><?php echo $this->Paginator->sort('date_from');?></th>
			<th><?php echo $this->Paginator->sort('date_to');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($plans as $plan):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $plan['Plan']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($plan['LineMachine']['name'], array('controller' => 'line_machines', 'action' => 'view', $plan['LineMachine']['id'])); ?>
		</td>
		<td><?php echo $plan['Plan']['shift_day']; ?>&nbsp;</td>
		<td><?php echo $plan['Plan']['shift_night']; ?>&nbsp;</td>
		<td><?php echo $plan['Plan']['date_from']; ?>&nbsp;</td>
		<td><?php echo $plan['Plan']['date_to']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $plan['Plan']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $plan['Plan']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $plan['Plan']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plan['Plan']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Plan', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plan Details', true), array('controller' => 'plan_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan Detail', true), array('controller' => 'plan_details', 'action' => 'add')); ?> </li>
	</ul>
</div>