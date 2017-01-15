<div class="paretoDetails form">
<?php echo $this->Form->create('ParetoDetail');?>
	<fieldset>
		<legend><?php __('Edit Pareto Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('pareto_id');
		echo $this->Form->input('model_no_id');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ParetoDetail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ParetoDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pareto Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Paretos', true), array('controller' => 'paretos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto', true), array('controller' => 'paretos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Model Nos', true), array('controller' => 'model_nos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Model No', true), array('controller' => 'model_nos', 'action' => 'add')); ?> </li>
	</ul>
</div>