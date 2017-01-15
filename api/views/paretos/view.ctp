<div class="paretos view">
<h2><?php  __('Pareto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pareto['Pareto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Line Machine'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pareto['LineMachine']['name'], array('controller' => 'line_machines', 'action' => 'view', $pareto['LineMachine']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pareto Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pareto['Pareto']['pareto_date']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pareto', true), array('action' => 'edit', $pareto['Pareto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pareto', true), array('action' => 'delete', $pareto['Pareto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pareto['Pareto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Paretos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Line Machines', true), array('controller' => 'line_machines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Line Machine', true), array('controller' => 'line_machines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pareto Details', true), array('controller' => 'pareto_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto Detail', true), array('controller' => 'pareto_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Pareto Details');?></h3>
	<?php if (!empty($pareto['ParetoDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Pareto Id'); ?></th>
		<th><?php __('Model No Id'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pareto['ParetoDetail'] as $paretoDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $paretoDetail['id'];?></td>
			<td><?php echo $paretoDetail['pareto_id'];?></td>
			<td><?php echo $paretoDetail['model_no_id'];?></td>
			<td><?php echo $paretoDetail['quantity'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pareto_details', 'action' => 'view', $paretoDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pareto_details', 'action' => 'edit', $paretoDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pareto_details', 'action' => 'delete', $paretoDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paretoDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pareto Detail', true), array('controller' => 'pareto_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
