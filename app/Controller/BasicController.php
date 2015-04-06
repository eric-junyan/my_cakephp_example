<?php

App::uses('AppController', 'Controller');

class BasicController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Time');
    public $components = array('Session');

    public function index() {
    }
}
