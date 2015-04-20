<?php

App::uses('AppModel', 'Model');

class Show extends AppModel {
    public $validate = array(
        'youku_id' => array(
            'rule' => 'isUnique'
        ),
        'tudou_id' => array(
            'rule' => 'isUnique'
        )
    );
}
