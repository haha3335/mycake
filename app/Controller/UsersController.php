<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
	
	
    public function beforeFilter() {
		$this->Auth->autoRedirect = false;
        parent::beforeFilter();
        $this->Auth->allow('add');// Letting users register themselves
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
	
	public function lists() {
        $this->set('users', $this->User->find('all'));
		//$this->set('users', $this->Post->User->find('all'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'),'default', array('class' => 'alert alert-error'));
            }
        }
    }


  public function login() {
	  
	  
	  
	  
	  if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            
			//$this->Session->setFlash(__('Invalid username or password, try again'));
			$this->Session->setFlash(__('Invalid username or password, try again'),'default', array('class' => 'alert alert-error'));
        }
    }
	  
	  
      /*if($this->Auth->login()) {
		     $this->redirect(array('controller' => 'posts', 'action' => 'index'));
		  }

      elseif (!$this->Auth->login()){
		 $this->Session->setFlash(__('username or password error'));
		  }
		  
		else{
			echo "hahahahahah";
			//$this->redirect(array('controller' => 'posts', 'action' => 'index');
		    }*/
			
	}


 public function logout() {
	 
	     $this->Session->setFlash('You have been logged out.','default', array('class' => 'alert alert-info'));   
	     $this->redirect($this->Auth->logout());
        //$this->Auth->logout();
	   //$this->redirect(array('action' => 'login'));
	}



    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'),'default', array('class' => 'alert alert-error'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('controller' => 'posts', 'action' => 'index'));
    }
}