<div class="lineMachines form">
<?php echo $this->Form->create('LineMachine');?>
	<fieldset>
		<legend><?php __('Edit Line Machine'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('department_code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('LineMachine.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('LineMachine.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>