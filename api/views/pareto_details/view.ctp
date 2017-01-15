<div class="paretoDetails view">
<h2><?php  __('Pareto Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paretoDetail['ParetoDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pareto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($paretoDetail['Pareto']['id'], array('controller' => 'paretos', 'action' => 'view', $paretoDetail['Pareto']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Model No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($paretoDetail['ModelNo']['name'], array('controller' => 'model_nos', 'action' => 'view', $paretoDetail['ModelNo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $paretoDetail['ParetoDetail']['quantity']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pareto Detail', true), array('action' => 'edit', $paretoDetail['ParetoDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pareto Detail', true), array('action' => 'delete', $paretoDetail['ParetoDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paretoDetail['ParetoDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pareto Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Paretos', true), array('controller' => 'paretos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto', true), array('controller' => 'paretos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Model Nos', true), array('controller' => 'model_nos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Model No', true), array('controller' => 'model_nos', 'action' => 'add')); ?> </li>
	</ul>
</div>
