<div class="planDetails form">
<?php echo $this->Form->create('PlanDetail');?>
	<fieldset>
		<legend><?php __('Edit Plan Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('plan_id');
		echo $this->Form->input('work_hour');
		echo $this->Form->input('cycle_time');
		echo $this->Form->input('target_efficiency');
		echo $this->Form->input('target_delivery');
		echo $this->Form->input('shift_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PlanDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PlanDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plan Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Plans', true), array('controller' => 'plans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan', true), array('controller' => 'plans', 'action' => 'add')); ?> </li>
	</ul>
</div>