<?php

App::uses('AppController', 'Controller');

class PrototypeController extends AppController {
    public $helpers = array('Js', 'Html', 'Form', 'Session', 'Time');
    public $components = array('RequestHandler', 'Session', 'Paginator');
    public $uses = array('Show', 'Episode');
    public $names = "Ajaxs";

    public function show($sid = 0) {
        $this->set('show', $this->Show->read(null, $sid));
        $this->set('videos', $this->Episode->find('all', array(
            'conditions'=>array(
                'Episode.show_id' => $sid
            )
        )));
    }

    public function youkuvideo($vid = 0) {
        $this->set('video', $this->Episode->read(null, $vid));
    }

    public function tudouvideo($tid = 0) {
        $this->set('video', $this->Episode->read(null, $tid));
    }

    public function index() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array(
                'Show.updated_at' => 'desc'
            )
        );
        //$this->log($this->paginate('Post'), 'debug');
        $this->set('shows', $this->paginate('Show'));
    }

    public function search() {
        $this->autoRender = FALSE;
        $shows =  $this->Show->find('all', array(
            'conditions'=>array(
                'Show.name like' => '%'.$this->request->query['keyword'].'%'
            )
        ));
        $this->response->type('json');
        echo json_encode(compact(true, 'shows'));
        //$this->render( '/Elements/Ajaxs/animesearch','ajax' );
        //$this->log($shows, 'debug');
    }

}
