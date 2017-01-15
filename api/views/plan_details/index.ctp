<div class="planDetails index">
	<h2><?php __('Plan Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('plan_id');?></th>
			<th><?php echo $this->Paginator->sort('work_hour');?></th>
			<th><?php echo $this->Paginator->sort('cycle_time');?></th>
			<th><?php echo $this->Paginator->sort('target_efficiency');?></th>
			<th><?php echo $this->Paginator->sort('target_delivery');?></th>
			<th><?php echo $this->Paginator->sort('shift_no');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($planDetails as $planDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $planDetail['PlanDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planDetail['Plan']['id'], array('controller' => 'plans', 'action' => 'view', $planDetail['Plan']['id'])); ?>
		</td>
		<td><?php echo $planDetail['PlanDetail']['work_hour']; ?>&nbsp;</td>
		<td><?php echo $planDetail['PlanDetail']['cycle_time']; ?>&nbsp;</td>
		<td><?php echo $planDetail['PlanDetail']['target_efficiency']; ?>&nbsp;</td>
		<td><?php echo $planDetail['PlanDetail']['target_delivery']; ?>&nbsp;</td>
		<td><?php echo $planDetail['PlanDetail']['shift_no']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $planDetail['PlanDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $planDetail['PlanDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $planDetail['PlanDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $planDetail['PlanDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Plan Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Plans', true), array('controller' => 'plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan', true), array('controller' => 'plans', 'action' => 'add')); ?> </li>
	</ul>
</div>