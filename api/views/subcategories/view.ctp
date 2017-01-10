<div class="subcategories view">
<h2><?php  __('Subcategory');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategory['Subcategory']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Kpi'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($subcategory['Kpi']['name'], array('controller' => 'kpis', 'action' => 'view', $subcategory['Kpi']['code'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategory['Subcategory']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategory['Subcategory']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subcategory['Subcategory']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subcategory', true), array('action' => 'edit', $subcategory['Subcategory']['code'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Subcategory', true), array('action' => 'delete', $subcategory['Subcategory']['code']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subcategory['Subcategory']['code'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subcategories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subcategory', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Kpis', true), array('controller' => 'kpis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kpi', true), array('controller' => 'kpis', 'action' => 'add')); ?> </li>
	</ul>
</div>
