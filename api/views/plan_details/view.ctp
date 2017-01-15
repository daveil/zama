<div class="planDetails view">
<h2><?php  __('Plan Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planDetail['PlanDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Plan'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($planDetail['Plan']['id'], array('controller' => 'plans', 'action' => 'view', $planDetail['Plan']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Work Hour'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planDetail['PlanDetail']['work_hour']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cycle Time'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planDetail['PlanDetail']['cycle_time']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Target Efficiency'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planDetail['PlanDetail']['target_efficiency']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Target Delivery'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planDetail['PlanDetail']['target_delivery']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Shift No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $planDetail['PlanDetail']['shift_no']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plan Detail', true), array('action' => 'edit', $planDetail['PlanDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Plan Detail', true), array('action' => 'delete', $planDetail['PlanDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $planDetail['PlanDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plan Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plans', true), array('controller' => 'plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan', true), array('controller' => 'plans', 'action' => 'add')); ?> </li>
	</ul>
</div>
