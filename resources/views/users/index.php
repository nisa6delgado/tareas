<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">
		Usuarios

		<a href="/users/create" class="btn btn-primary btn-sm float-right create">
			<i class="fa fa-copy"></i> 
			Crear
		</a>
	</h1>

	<?php if ($users->count()): ?>
		<table class="table" width="100%" id="datatables">
			<thead>
				<tr>
					<th data-priority="1">ID</th>
					<th>Foto</th>
					<th data-priority="2">Nombre</th>
					<th>Correo electrónico</th>
					<th>Opciones</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><img class="user_list" src="<?php echo ($user->photo) ? $user->photo : asset('img/app/user.png'); ?>" alt=""></td>
						<td><?php echo $user->name; ?></td>
						<td><?php echo $user->email; ?></td>
						<td>
							<a href="<?php echo '/users/edit/' . $user->id; ?>" class="btn btn-secondary btn-sm edit">
								<i class="fa fa-edit"></i> Editar
							</a>

							<?php if ($user->id != auth()->id): ?>
								<a href="<?php echo '/users/delete/' . $user->id; ?>" class="btn btn-danger btn-sm delete">
									<i class="fa fa-trash"></i> Eliminar
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="alert alert-info">No se han registrado usuarios</div>
	<?php endif; ?>
</div>

<script src="<?php asset('js/users.js'); ?>"></script>