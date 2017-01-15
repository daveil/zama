<div class="paretos form">
<?php echo $this->Form->create('Pareto');?>
	<fieldset>
		<legend><?php __('Edit Pareto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('line_machine_id');
		echo $this->Form->input('pareto_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Pareto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Pareto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Paretos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pareto Details', true), array('controller' => 'pareto_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto Detail', true), array('controller' => 'pareto_details', 'action' => 'add')); ?> </li>
	</ul>
</div>