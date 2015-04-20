<?php

App::uses('AppModel', 'Model');

class Episode extends AppModel {
    public $validate = array(
        'youku_id' => array(
            'rule' => 'isUnique'
        ),
        'tudou_id' => array(
            'rule' => 'isUnique'
        )
    );
}
