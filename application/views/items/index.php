<div class="row-fluid">
	<?php foreach ($items as $item): ?>
		<div class="span4">
			<h2><?php echo $item->name ?></h2>
			<p><?php echo $item->description ?></p>
		</div>
	<?php endforeach ?>
</div>