<div class="modelNos view">
<h2><?php  __('Model No');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['department_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['category_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Kpi Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['kpi_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subcategory Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['subcategory_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Line Machine'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($modelNo['LineMachine']['name'], array('controller' => 'line_machines', 'action' => 'view', $modelNo['LineMachine']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $modelNo['ModelNo']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Model No', true), array('action' => 'edit', $modelNo['ModelNo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Model No', true), array('action' => 'delete', $modelNo['ModelNo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modelNo['ModelNo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Model Nos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Model No', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
	</ul>
</div>
