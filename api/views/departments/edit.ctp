<div class="departments form">
<?php echo $this->Form->create('Department');?>
	<fieldset>
		<legend><?php __('Edit Department'); ?></legend>
	<?php
		echo $this->Form->input('code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Department.code')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Department.code'))); ?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cavities', true), array('controller' => 'cavities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cavity', true), array('controller' => 'cavities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Nos', true), array('controller' => 'part_nos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part No', true), array('controller' => 'part_nos', 'action' => 'add')); ?> </li>
	</ul>
</div>