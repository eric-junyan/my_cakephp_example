<?php

App::uses('File', 'Utility');

class MyTestShell extends AppShell {
    public $uses = array('Thema');

    public function main() {
        $result = $this->Thema->findByName("hahahah");
        print_r($result);
        if(empty($result)){ print('empty'); }
    }
}
