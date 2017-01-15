<div class="rights form">
<?php echo $this->Form->create('Right');?>
	<fieldset>
		<legend><?php __('Add Right'); ?></legend>
	<?php
		echo $this->Form->input('group_id');
		echo $this->Form->input('module_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rights', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group', true), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modules', true), array('controller' => 'modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module', true), array('controller' => 'modules', 'action' => 'add')); ?> </li>
	</ul>
</div>