<div class="kpis index">
	<h2><?php __('Kpis');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('category_code');?></th>
			<th><?php echo $this->Paginator->sort('code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($kpis as $kpi):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $kpi['Kpi']['category_code']; ?>&nbsp;</td>
		<td><?php echo $kpi['Kpi']['code']; ?>&nbsp;</td>
		<td><?php echo $kpi['Kpi']['name']; ?>&nbsp;</td>
		<td><?php echo $kpi['Kpi']['created']; ?>&nbsp;</td>
		<td><?php echo $kpi['Kpi']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $kpi['Kpi']['code'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $kpi['Kpi']['code'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $kpi['Kpi']['code']), null, sprintf(__('Are you sure you want to delete # %s?', true), $kpi['Kpi']['code'])); ?>
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
		<li><?php echo $this->Html->link(__('New Kpi', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subcategories', true), array('controller' => 'subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subcategory', true), array('controller' => 'subcategories', 'action' => 'add')); ?> </li>
	</ul>
</div>