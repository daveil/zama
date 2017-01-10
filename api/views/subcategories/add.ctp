<div class="subcategories form">
<?php echo $this->Form->create('Subcategory');?>
	<fieldset>
		<legend><?php __('Add Subcategory'); ?></legend>
	<?php
		echo $this->Form->input('kpi_code');
		echo $this->Form->input('code',array('type'=>'text'));
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Subcategories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Kpis', true), array('controller' => 'kpis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kpi', true), array('controller' => 'kpis', 'action' => 'add')); ?> </li>
	</ul>
</div>