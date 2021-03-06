<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Le Bon Campus</title>
	<meta charset="utf-8" />
	<meta name="description" content="Acheter ou vendez !!" />
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/bootstrap-theme.min.css') !!}
	{!! Html::style('css/bootstrap.css.map') !!}
	{!! Html::style('css/bootstrap-theme.css.map') !!}
	{!! Html::style('css/fixed-top.css') !!}
	{!! Html::script('js/jquery-2.1.3.js') !!}
	{!! Html::script('js/bootstrap.min.js') !!}
	{!! Html::script('js/recherche.js') !!}
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<?php
	$annonces = DB::table('annonces')->where('user_id', Auth::user()->id)->get();
	?>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="../panel">Le Bon Campus</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="panel">Home</a></li>
					<li><a href="profil">Profil</a></li>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Annonces<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="ajoutAnnonce">Ajouter</a></li>
							<li><a href="displayAllAnnonce">Tout les annonces</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Vos Annonces</li>
							<li class="active"><a href="updateUserAnnonce">Modifier ou Supprimer</a></li>
							<li><a href="displayUserAnnonce">Les voir</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="recherche">Recherche</a></li>
					<li>
						{!! Form::open(['url' => 'deco']) !!}
						{!! Form::submit('Deconnexion', ['class' => 'btn btn-primary form-control']) !!}
						{!! Form::close() !!}
					</li>
					<li><a href="message">Message</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
	if (Session::has('messageDejaCo')) {
		?>
		<div class="alert alert-warning" role="alert">{!! Session::get('messageDejaCo') !!}</div>
		<?php
	}
	if (Session::has('messagePasImage')) {
		?>
		<div class="alert alert-danger" role="alert">{!! Session::get('messagePasImage') !!}</div>
		<?php
	}
	if (Session::has('messageUpdateAnnonce')) {
		?>
		<div class="alert alert-success" role="alert">{!! Session::get('messageUpdateAnnonce') !!}</div>
		<?php
	}
	if (Session::has('messageDeleteAnnonce')) {
		?>
		<div class="alert alert-success" role="alert">{!! Session::get('messageDeleteAnnonce') !!}</div>
		<?php
	}
	?>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
			<p>Vous pouvez modifier vos annonces ici via le formulaire !!</p>
			<?php
			foreach ($annonces as $value) {
				$images = explode("|", $value->picture);
				?>
				{!! Form::open(['url' => 'updateCurrentAnnonce' , 'files'=>true]) !!}
				<div class="form-group">
					{!! Form::hidden('id', $value->id) !!}
					<label>Titre :</label>
					{!! Form::text('titre', $value->titre, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					<label>Numero de telephpne :</label>
					{!! Form::text('tel', $value->numero, ['class' => 'form-control', 'placeholder' => 'Votre pseudo']) !!}
				</div>
				<div class="form-group">
					<label>Prix :</label>
					<input type="number" name="prix" value='{!! $value->prix !!}' class="form-control" min="0" max="9999" />
				</div>
				<div class="form-group">
					<label>Type de monnaie :</label>
					{!! Form::select('typePrix', [
					'€' => 'Euro (€)',
					'$' => 'Dollar ($)',
					'¥ JPY' => 'Yen Japonais (¥)',
					'¥ CNY' => 'Yuan Chinois (¥)',
					'₩' => 'Won Sud-Coréen (₩)',
					'₺' => 'Livre Turque (₺)',
					'₽' => 'Rouble Russe (₽)'
					], $value->monnaie,
					['class' => 'form-control']
					) !!}
				</div>
				<div class="form-group">
					<label>Description :</label>
					{!! Form::textarea('description', $value->description, ['class' => 'form-control', 'placeholder' => 'Votre eMail']) !!}
				</div>
				<?php
				if (4 - count($images) > 1) {
					?><h2>Vous pouvez ajouter encore <?php echo 4 - count($images);?> images :</h2>
					<div class="form-group">
						<label>Images :</label>
						{!! Form::input('file', 'file[]', null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
					</div>
					<?php
				}
				if (4 - count($images) == 0) {
					?><h2>Vous ne pouvez plus ajouter d'image !!</h2>
					<?php
				}
				if (4 - count($images) == 1) {
					?><h2>Vous pouvez ajouter encore <?php echo 4 - count($images);?> image :</h2>
					<div class="form-group">
						<label>Image :</label>
						{!! Form::input('file', 'file[]', null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
					</div>
					<?php
				}
				?>
				<div class="form-group">
					{!! Form::submit('Modifier votre annonce !!', ['class' => 'btn btn-primary form-control']) !!}
				</div>
				{!! Form::close() !!}
				{!! Form::open(['url' => 'deleteCurrentAnnonce']) !!}
				<div class="form-group">
					{!! Form::hidden('id', $value->id) !!}
					{!! Form::submit('Supprimer cette annonce !!', ['class' => 'btn btn-primary form-control']) !!}
				</div>
				{!! Form::close() !!}
				<?php
			}
			?>
		</div>
		<?php
		foreach ($annonces as $value) {
			$images = explode("|", $value->picture);
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{!! $value->titre !!}</h3>
				</div>
				<div class="panel-body">
					<p>Numero de téléphone : {!! $value->numero !!}</p>
					<p>Email du vendeur : {!! $value->email !!}</p>
					<p>Prix : {!! $value->prix !!} {!! $value->monnaie !!}</p>
				</div>
				<div class="panel-body">
					<p>{!! $value->description !!}</p>
					<?php
					foreach ($images as $valueImage) {
						?>
						<img class="img-thumbnail" src='{!! url() !!}/../../storage/user-{!! Auth::user()->id !!}/{!! $value->id !!}/{!! $valueImage !!}' alt='{!! $value->description !!}'>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		?>
	</div> 
</body>
</html>