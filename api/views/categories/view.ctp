<div class="categories view">
<h2><?php  __('Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Department'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($category['Department']['name'], array('controller' => 'departments', 'action' => 'view', $category['Department']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category', true), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Category', true), array('action' => 'delete', $category['Category']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments', true), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department', true), array('controller' => 'departments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Kpis', true), array('controller' => 'kpis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kpi', true), array('controller' => 'kpis', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Kpis');?></h3>
	<?php if (!empty($category['Kpi'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Category Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['Kpi'] as $kpi):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $kpi['id'];?></td>
			<td><?php echo $kpi['category_id'];?></td>
			<td><?php echo $kpi['name'];?></td>
			<td><?php echo $kpi['created'];?></td>
			<td><?php echo $kpi['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'kpis', 'action' => 'view', $kpi['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'kpis', 'action' => 'edit', $kpi['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'kpis', 'action' => 'delete', $kpi['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $kpi['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Kpi', true), array('controller' => 'kpis', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
