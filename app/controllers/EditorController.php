<?php 
class EditorController extends BaseController
{
	public function ListeArticle()
	{	$articles = DB::select('SELECT * from Article');
		return View::make('editor.list',array('articles'=>$articles));
	}
	public function NewArticle()
	{
		DB::table('Article')->insert(array('slug'=>Input::get('slug'),'date_modif'=>Input::get('date'),'editor'=>Input::get('editor'),'markdown'=>Input::get('markdown'),'title'=>Input::get('title')));

		return Redirect::to('editor');
	}
	public function ShowEdit($id)
	{	$article=DB::table('Article')->where('id',$id)->first();
		return View::make('editor.edit',array('article'=>$article,'render'=>Markdown::render($article->markdown)));
	}
	public function Edit($id)
	{
		DB::table('Article')
			->where('id',$id)
			->update(array(	'slug'			=>Input::get('slug'),
							'date_modif'	=>Input::get('date'),
							'editor'		=>Input::get('editor'),
							'markdown'		=>Input::get('markdown'),
							'title'			=>Input::get('title')
							)
					);
		return Redirect::to('editor');
	}
}
?>