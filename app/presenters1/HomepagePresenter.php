<?php
namespace App\Presenters;
use Nette;
use App\Model;
use Nette\Application\UI;
class HomepagePresenter extends UI\Presenter{
    /** @var Nette\Database\Context */
    private $database;
    public function __construct(Nette\Database\Context $database){
        $this->database = $database;
    }
	public function renderDefault(){
    	$this->template->posts = $this->database->table('posts')->order('post_id DESC');
		$this->template->cnt = 0;
	}
	protected function createComponentPostForm(){
	    $form = new UI\Form;
	    $form->addText('title', 'Your title:')->setRequired();
	    $form->addTextArea('content', 'Content:')->setRequired();
	    $form->addSubmit('save', 'Publish Post');
	    $form->onSuccess[] = array($this, 'postFormSucceeded');
	    return $form;
	}
	public function postFormSucceeded($form, $values){
	    $postId = $this->getParameter('postId');
	    if($postId) {
	        $post = $this->database->table('posts')->get($postId);
	        $post->update($values);
	    }else{
	        $post = $this->database->table('posts')->insert($values);
	    }
	    $this->flashMessage('Post was published', 'success');
	    $this->redirect('this');
	}
	public function actionEdit($postId){
	    $post = $this->database->table('posts')->get($postId);
	    if (!$post) {
	        $this->error('Post not found');
	    }
	    $this['postForm']->setDefaults($post->toArray());
	}	
}