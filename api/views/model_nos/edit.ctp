<div class="modelNos form">
<?php echo $this->Form->create('ModelNo');?>
	<fieldset>
		<legend><?php __('Edit Model No'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('kpi_id');
		echo $this->Form->input('subcategory_id');
		echo $this->Form->input('line_machine_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ModelNo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ModelNo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Model Nos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
	</ul>
</div>