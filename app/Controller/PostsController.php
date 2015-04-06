<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Time');
    public $components = array('Session', 'Paginator');


    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array(
                'Post.modified_at' => 'desc'
            )
        );
        $this->log($this->paginate('Post'), 'debug');
        $this->set('posts', $this->paginate('Post'));
    }

    public function view($id = null) {
        $this->set('posts', $this->Post->find('all'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($new_post = $this->Post->save($this->request->data)) {
                $this->log($new_post, 'debug');
                $this->Session->setFlash(__('Your post has been saved.'), 'alert', array(
                        'plugin' => 'BoostCake',
                        'class' => 'alert-success'
                ));;
                return $this->redirect(array('action' => 'view', '#' => $new_post['Post']['id']));
            }
            $this->Session->setFlash(__('Unable to add your post.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-danger'
            ));;
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'), 'alert', array(
                        'plugin' => 'BoostCake',
                        'class' => 'alert-success'
                ));;
                return $this->redirect(array('action' => 'view', '#' => $id));
            }
            $this->Session->setFlash(__('Unable to update your post.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-danger'
            ));;
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id = null) {
         if (!$id) {
            throw new NotFoundException(__('Invalid delete'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid delete'));
        }

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('The post with id: %s has been deleted.', h($post['title'])), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
            ));;
        } else {
            $this->Session->setFlash(__('The post with id: %s could not be deleted.', h($post['title'])), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-danger'
            ));;
        }

        return $this->redirect(array('action' => 'view', '#' => $id));
    }
}
