<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">
		Editar usuario
	</h1>

	<form class="update mb-5">
		<div class="row">
			<div class="col-md-12 mb-4 text-center">
				<label for="user">
					<img src="<?php echo ($user->photo != '') ? $user->photo : asset('img/app/user.png'); ?>" class="user_photo">
				</label>

				<input type="file" name="photo" id="user">
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" class="form-control" name="name" required value="<?php echo $user->name; ?>">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="email">Correo electrónico</label>
					<input type="text" class="form-control" name="email" required value="<?php echo $user->email; ?>">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="password">Contraseña</label>
					<div class="input-group">
						<input type="password" class="form-control" name="password">
						<div class="input-group-append">
							<button type="button" class="btn btn-secondary password">
								<i class="fa fa-eye"></i>
							</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="confirm_password">Confirmar contraseña</label>
					<div class="input-group">
						<input type="password" class="form-control" name="confirm_password">
						<div class="input-group-append">
							<button type="button" class="btn btn-secondary password">
								<i class="fa fa-eye"></i>
							</button>
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="id" value="<?php echo $user->id; ?>">

			<div class="col-md-12">
				<button type="submit" class="btn btn-primary submit">
					<i class="fa fa-save"></i> Editar usuario
				</button>

				<a href="/users" class="btn btn-danger cancel">
					<i class="fa fa-times"></i> Cancelar
				</a>
			</div>
		</div>
	</form>
</div>

<script src="<?php asset('js/users.js'); ?>"></script>