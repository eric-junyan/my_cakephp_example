<?php

App::uses('AppModel', 'Model');

class Post extends AppModel {
    public function beforeSave($options = array()) {
        if(!$this->findById($this->data['Post']['id'])) {
            $this->data['Post']['created_at'] = time();
        }
        $this->data['Post']['modified_at'] = time();
    }

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}
