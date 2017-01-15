<div class="paretoDetails index">
	<h2><?php __('Pareto Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('pareto_id');?></th>
			<th><?php echo $this->Paginator->sort('model_no_id');?></th>
			<th><?php echo $this->Paginator->sort('quantity');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($paretoDetails as $paretoDetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $paretoDetail['ParetoDetail']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paretoDetail['Pareto']['id'], array('controller' => 'paretos', 'action' => 'view', $paretoDetail['Pareto']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($paretoDetail['ModelNo']['name'], array('controller' => 'model_nos', 'action' => 'view', $paretoDetail['ModelNo']['id'])); ?>
		</td>
		<td><?php echo $paretoDetail['ParetoDetail']['quantity']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $paretoDetail['ParetoDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $paretoDetail['ParetoDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $paretoDetail['ParetoDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paretoDetail['ParetoDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Pareto Detail', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Paretos', true), array('controller' => 'paretos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pareto', true), array('controller' => 'paretos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Model Nos', true), array('controller' => 'model_nos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Model No', true), array('controller' => 'model_nos', 'action' => 'add')); ?> </li>
	</ul>
</div>