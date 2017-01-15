<div class="modules form">
<?php echo $this->Form->create('Module');?>
	<fieldset>
		<legend><?php __('Add Module'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Modules', true), array('action' => 'index'));?></li>
	</ul>
</div>