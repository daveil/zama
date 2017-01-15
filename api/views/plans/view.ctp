<div class="plans view">
<h2><?php  __('Plan');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Line Machine'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($plan['LineMachine']['name'], array('controller' => 'line_machines', 'action' => 'view', $plan['LineMachine']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shift Day'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['shift_day']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shift Night'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['shift_night']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date From'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['date_from']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date To'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $plan['Plan']['date_to']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plan', true), array('action' => 'edit', $plan['Plan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Plan', true), array('action' => 'delete', $plan['Plan']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $plan['Plan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plans', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plan Details', true), array('controller' => 'plan_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan Detail', true), array('controller' => 'plan_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Plan Details');?></h3>
	<?php if (!empty($plan['PlanDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Plan Id'); ?></th>
		<th><?php __('Work Hour'); ?></th>
		<th><?php __('Cycle Time'); ?></th>
		<th><?php __('Target Efficiency'); ?></th>
		<th><?php __('Target Delivery'); ?></th>
		<th><?php __('Shift No'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($plan['PlanDetail'] as $planDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $planDetail['id'];?></td>
			<td><?php echo $planDetail['plan_id'];?></td>
			<td><?php echo $planDetail['work_hour'];?></td>
			<td><?php echo $planDetail['cycle_time'];?></td>
			<td><?php echo $planDetail['target_efficiency'];?></td>
			<td><?php echo $planDetail['target_delivery'];?></td>
			<td><?php echo $planDetail['shift_no'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'plan_details', 'action' => 'view', $planDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'plan_details', 'action' => 'edit', $planDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'plan_details', 'action' => 'delete', $planDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $planDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Plan Detail', true), array('controller' => 'plan_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
