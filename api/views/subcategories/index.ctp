<div class="subcategories index">
	<h2><?php __('Subcategories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('kpi_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($subcategories as $subcategory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $subcategory['Subcategory']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subcategory['Kpi']['name'], array('controller' => 'kpis', 'action' => 'view', $subcategory['Kpi']['id'])); ?>
		</td>
		<td><?php echo $subcategory['Subcategory']['name']; ?>&nbsp;</td>
		<td><?php echo $subcategory['Subcategory']['created']; ?>&nbsp;</td>
		<td><?php echo $subcategory['Subcategory']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $subcategory['Subcategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $subcategory['Subcategory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $subcategory['Subcategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $subcategory['Subcategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Subcategory', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Kpis', true), array('controller' => 'kpis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kpi', true), array('controller' => 'kpis', 'action' => 'add')); ?> </li>
	</ul>
</div>