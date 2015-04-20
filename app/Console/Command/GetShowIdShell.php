<?php

App::uses('File', 'Utility');

class GetShowIdShell extends AppShell {
    public $uses = array('Show', 'Thema');

    public function main() {
        $from_no =  $this->args[0];
        $themas = $this->getThemas($from_no);
        foreach($themas as $thema) {
            if ($this->checkShowIfSaved($thema['Thema']['id'])){ continue; }
            print($thema['Thema']['name'] . " is in searching.\n");
            print($thema['Thema']['id'] . "\n");
            sleep(5);

            try {
                $results = $this->getShow($thema['Thema']['name']);
                if ($results->total === 0) {
                    print($thema['Thema']['name'] . " can not be found.\n");
                    continue;
                }
                $this->insertIntoShows($results->shows, $thema['Thema']['id']);
            } catch(Exception $e) {
                print("there is something wrong in http get, lets pass it.\n");
                continue;
            }
        }

    }

    private function checkShowIfSaved($thema_id) {
        return !empty($this->Show->findByThemaId($thema_id));
    }

    private function getThemas($from_no) {
        return $this->Thema->find('all', array(
            'conditions'=>array(
                'Thema.id >=' => $from_no
            )
        ));
    }

    private function getShow($keyword) {
        $url = "https://openapi.youku.com/v2/searches/show/by_keyword.json";
        $data = array(
            'client_id' => '987302dd59060846',
            'keyword' => $keyword
        );
        App::uses('HttpSocket', 'Network/Http');
        $HttpSocket = new HttpSocket();
        $results = $HttpSocket->get($url, array($data));
        $response = json_decode($results->body);

        return $response;
    }

    private function insertIntoShows($shows, $thema_id){
        foreach($shows as $show) {
            $show_info = array(
                    'youku_id' => $show->id,
                    'thema_id' => $thema_id,
                    'name' => $show->name,
                    'description' => $show->description,
                    'image_url' => $show->poster,
                    'released_at' => $show->published
                );
            $this->Show->create();
            $this->Show->save($show_info);
        }
    }
}
