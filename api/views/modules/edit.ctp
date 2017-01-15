<div class="modules form">
<?php echo $this->Form->create('Module');?>
	<fieldset>
		<legend><?php __('Edit Module'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Module.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Module.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Modules', true), array('action' => 'index'));?></li>
	</ul>
</div>