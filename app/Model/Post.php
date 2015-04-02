<?php

App::uses('AppModel', 'Model');

class Post extends AppModel {
    public function beforeSave($options = array()) {
        if(empty($this->data['Post']['created_at'])) {
            $this->data['Post']['created_at'] = time();
        }
        if(empty($this->data['Post']['modified_at'])) {
            $this->data['Post']['modified_at'] = time();
        }
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
