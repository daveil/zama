<div class="paretoDetails form">
<?php echo $this->Form->create('ParetoDetail');?>
	<fieldset>
		<legend><?php __('Add Pareto Detail'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Pareto Details', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Paretos', true), array('controller' => 'paretos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto', true), array('controller' => 'paretos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Model Nos', true), array('controller' => 'model_nos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Model No', true), array('controller' => 'model_nos', 'action' => 'add')); ?> </li>
	</ul>
</div>