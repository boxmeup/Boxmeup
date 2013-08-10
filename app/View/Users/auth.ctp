<h2><?php echo __('My Authenticated Applications'); ?></h2>
<?php if (empty($applications)) : ?>
	<p><?php echo __('No authenticated applications.') ?></p>
<?php else: ?>
	<table class="table">
		<thead>
			<tr>
				<th><?php echo __('Application') ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($applications as $app): ?>
			<tr>
				<td><?php echo $app['ApiUserApplication']['name'] ?></td>
				<td><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'revoke', $app['ApiUserApplication']['id'])) ?>" class="btn btn-danger pull-right"><?php echo __('Revoke') ?></a></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
<?php endif ?>
