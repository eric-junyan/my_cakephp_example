<?php

App::uses('File', 'Utility');

class InputdbShell extends AppShell {
    public $uses = array('Thema');

    public function main() {
        $file = new File('./Command/Input/thema.csv');
        $titles = $file->read();
        $title_array = explode("\n", $titles);
        foreach ($title_array as $title) {
            $this->Thema->create();
            $this->Thema->save(array('name'=>$title));
        }
        print_r($this->Thema->find('first'));
    }
}
