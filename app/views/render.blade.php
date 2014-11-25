<html>
<head>
	<meta charset="UTF-8">
	<title>{{ $article->title }}</title>
	@include('editor.head')
</head>
<script>hljs.initHighlightingOnLoad();</script>
<body>
<div class="menupanel">
<?php

$pages=DB::table('Article')->orderby('slug')->get();
$slugtab=array();
foreach ($pages as $page) {
$slugpage=explode('/',$page->slug);
$tab=&$slugtab;
	foreach ($slugpage as $branch) {
		if(!isset($tab[$branch]))
		{
			$tab[$branch]=array();
		}	
		$tab=&$tab[$branch];
	}
}
RecursiveForeach($slugtab,'');
function RecursiveForeach($slugs,$url)
{$pattern=str_replace(Request::root(), '', Request::fullUrl());
	foreach ($slugs as $slug => $value) {
		
		if(preg_match('#^'.$url.'/'.$slug.'#', $pattern))
			$goodpath=true;
		else
			$goodpath=false;
		
		if(sizeof($value)!=0)
		{	if(!$goodpath)
			{
				echo '<li class="li" id="'.$url.'/'.$slug.'"><div  onclick="Shower(this);return false;"  class="liclose" width="11" height="11"></div><a href="'.URL::to($url.'/'.$slug).'">'.ucfirst($slug).'</a><ul class="submenu close" id="'.$slug.'child">';
				RecursiveForeach($value,$url.'/'.$slug);
				echo '</ul></li>';
			}
			else
			{
				echo '<li class="li" id="'.$url.'/'.$slug.'"><div  onclick="Shower(this);return false;"  class="liopen" width="11" height="11"></div><a href="'.URL::to($url.'/'.$slug).'">'.ucfirst($slug).'</a><ul class="submenu" id="'.$slug.'child">';
				RecursiveForeach($value,$url.'/'.$slug);
				echo '</ul></li>';
			}
			
		}
		else
		{	if(!$goodpath)
				echo '<li class="li"><div onclick="Shower(this);return false;"  class="liclose" width="11" height="11"></div><a unselectable="on" href="'.URL::to($url.'/'.$slug).'">'.ucfirst($slug).'</a></li>';
			else
				echo '<li class="li"><div onclick="Shower(this);return false;"  class="liopen" width="11" height="11"></div><a unselectable="on" href="'.URL::to($url.'/'.$slug).'">'.ucfirst($slug).'</a></li>';

		}
	}
}
?>
</div>
<div>
	<table style="width: 75%;">
		<tr>
			<td>Auteur : {{ $article->editor }}</td>
			<td style="text-align:right">Le : {{ $article->date_modif }}</td>
		</tr>
	</table>
</div>
	{{ Markdown::render($article->markdown) }}
<script type="text/javascript">
function Shower(element)
{	event.stopPropagation();	
	$(element).toggleClass('liopen');
		$(element).toggleClass('liclose');
		$(element).parent().children('ul').toggleClass('close');
}
	
</script>
</body>
</html>