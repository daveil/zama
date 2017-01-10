<div class="kpis view">
<h2><?php  __('Kpi');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($kpi['Category']['name'], array('controller' => 'categories', 'action' => 'view', $kpi['Category']['code'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $kpi['Kpi']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $kpi['Kpi']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $kpi['Kpi']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $kpi['Kpi']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Kpi', true), array('action' => 'edit', $kpi['Kpi']['code'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Kpi', true), array('action' => 'delete', $kpi['Kpi']['code']), null, sprintf(__('Are you sure you want to delete # %s?', true), $kpi['Kpi']['code'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Kpis', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kpi', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subcategories', true), array('controller' => 'subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subcategory', true), array('controller' => 'subcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Subcategories');?></h3>
	<?php if (!empty($kpi['Subcategory'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Code'); ?></th>
		<th><?php __('Kpi Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($kpi['Subcategory'] as $subcategory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $subcategory['code'];?></td>
			<td><?php echo $subcategory['kpi_code'];?></td>
			<td><?php echo $subcategory['name'];?></td>
			<td><?php echo $subcategory['created'];?></td>
			<td><?php echo $subcategory['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'subcategories', 'action' => 'view', $subcategory['code'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'subcategories', 'action' => 'edit', $subcategory['code'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'subcategories', 'action' => 'delete', $subcategory['code']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subcategory['code'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Subcategory', true), array('controller' => 'subcategories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
