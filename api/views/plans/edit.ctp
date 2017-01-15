<div class="plans form">
<?php echo $this->Form->create('Plan');?>
	<fieldset>
		<legend><?php __('Edit Plan'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('line_machine_id');
		echo $this->Form->input('shift_day');
		echo $this->Form->input('shift_night');
		echo $this->Form->input('date_from');
		echo $this->Form->input('date_to');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Plan.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Plan.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plans', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plan Details', true), array('controller' => 'plan_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plan Detail', true), array('controller' => 'plan_details', 'action' => 'add')); ?> </li>
	</ul>
</div>