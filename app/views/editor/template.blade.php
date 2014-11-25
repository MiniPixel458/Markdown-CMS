<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CMS Editor</title>
	@include('editor.head')
</head>
<body>
<div id="topmenu">
	<table>
		<tr>
			<td><a href="{{URL::to('editor/add')}}" class="menulink">Ajouter un Article</a></td>
			<td><a href="{{URL::to('editor')}}" class="menulink">Liste des Articles</a></td>
			<td><a href="{{URL::to('/')}}" class="menulink">Voir le résultat</a></td>
		</tr>
	</table>
</div>
<div class="contenu">
	@yield('contenu')
</div>
	
</body>
</html>

