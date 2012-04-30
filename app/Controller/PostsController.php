<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form','Session','Tinymce');
	var $paginate1 = array( 'fields' => array('Post.title', 'Post.created','Post.user_id'));
	var $paginate2 = array( 'fields' => array('User.username', 'User.role','User.created'));
	
    //public $components = array('Session');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
		$this->set('users', ClassRegistry::init('User')->find('all'));
		$this->set('posts', $this->paginate());
		//$this->set('users', $this->Post->User->find('all'));
    }

    public function view($id) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());

    }

    public function add() {
        if ($this->request->is('post')) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //request for user login
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.','default', array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.','default', array('class' => 'alert alert-error'));
            }
        }
    }



public function edit($id = null) {
    $this->Post->id = $id;
    if ($this->request->is('get')) {
        $this->request->data = $this->Post->read();
    } else {
        if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash('Your post has been updated.','default', array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Unable to update your post.','default', array('class' => 'alert alert-error'));
        }
    }
}



public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }
    if ($this->Post->delete($id)) {
        $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
        $this->redirect(array('controller' => 'posts', 'action' => 'index'));
    }
}


public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($postId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}






}