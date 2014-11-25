@extends('editor.template')
@section('contenu')
<table>
	<tr>
		<th>ID</th>
		<th>Titre</th>
		<th>Url</th>
		<th>Date</th>
		<th>Editeur</th>
		<th>Action</th>
	</tr>
	@foreach ($articles as $article)
    	<tr>
			<td>{{ $article->id }}</td>
			<td>{{ $article->title }}</td>
			<td>{{ $article->slug }}</td>
			<td>{{ $article->date_modif }}</td>
			<td>{{ $article->editor }}</td>
			<td><a href="{{ URL::to($article->slug) }}">Voir</a> - <a href="{{ URL::to('editor/edit/'.$article->id) }}">Modifier</a> - <a href="{{ URL::to('editor/delete/'.$article->id) }}">Supprimer</a></td>
		</tr>
	@endforeach

</table>
@stop