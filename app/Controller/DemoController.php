<?php

App::uses('AppController', 'Controller');

class DemoController extends AppController {
    public $helpers = array('Js', 'Html', 'Form', 'Session', 'Time');
    public $components = array('RequestHandler', 'Session', 'Paginator');

    public function show($sid = 0) {
        $this->set('sid', $sid);
    }

    public function youkuvideo($vid = 0) {
        $this->set('vid', $vid);
    }

    public function index() {
    }
}
