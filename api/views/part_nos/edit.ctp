<div class="partNos form">
<?php echo $this->Form->create('PartNo');?>
	<fieldset>
		<legend><?php __('Edit Part No'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PartNo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PartNo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Part Nos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>