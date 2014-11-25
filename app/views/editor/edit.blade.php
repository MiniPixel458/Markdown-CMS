@extends('editor.template')
@section('contenu')
<script>hljs.initHighlightingOnLoad();</script>
<h2>Edition Article</h2>
{{ Form::open(); }}
<table style="width:50%">
	<tr>
		<td>{{ Form::label('title',"Titre de l'article"); }}</td>
		<td>{{ Form::text('title',$article->title); }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('slug',"URL"); }}</td>
		<td>{{ Form::text('slug',$article->slug); }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('date',"Date"); }}</td>
		<td>{{ Form::text('date',date('d/m/Y')); }}</td>
	</tr>
	<tr>
		<td>{{ Form::label('editor',"Editeur"); }}</td>
		<td>{{ Form::text('editor',$article->editor); }}</td>
	</tr>
</table>
{{ Form::Submit('Sauvegarder',array('onclick' => "$('#markdown').val(editor.getValue())")); }}
<div>
	<textarea name="markdown" id="markdown">{{ $article->markdown }}</textarea>
	<div style="width:40%;display: inline-block;margin-top: -30px;">
		<h2>Preview</h2>
		<div id="preview" style="text-align: left;">{{ $render }}</div>
	</div>
</div>

{{ Form::close(); }}
<script>
	var editor = CodeMirror.fromTextArea(document.getElementById("markdown"), {
    lineNumbers: true,
    mode: {name: "markdown", globalVars: true}


  });
editor.on("change", function(){
	$.post( "../parser",{ markdown:editor.getValue()  }, function( data ) {
  		$( "#preview" ).html( data );
  		
	});
    
});
$('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });
</script>
@stop