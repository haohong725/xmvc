<?php
namespace app\controllers;

use framework\core\Controller as BaseController;
use framework\core\DI;
use app\models\PostModel;

class IndexController extends BaseController
{
	public function indexAction()
	{
		$db = DI::get('db');
		$result = $db->query("select");

		// $postModel = new PostModel();

		// $posts = $postModel->findPosts();

		// dd($posts);

		// $this->view->setLayout('layouts/default');
		// $this->view->render('index/index', ['name' => 'haohong']);
	}
}