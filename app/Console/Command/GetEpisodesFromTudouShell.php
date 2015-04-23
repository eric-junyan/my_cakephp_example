<?php

App::uses('File', 'Utility');

class GetEpisodesFromTudouShell extends AppShell {
    public $uses = array('Show', 'Episode');

    public function main() {
        $from_no =  $this->args[0];
        $videos = $this->getVideos($from_no);
        foreach($videos as $video) {
            if ($this->checkEpisodeIfHasBeenFound($video['Episode']['id'])){ continue; }
            print($video['Episode']['name'] . " is in mapping.\n");
            print($video['Episode']['id'] . "\n");
            sleep(1.5);

            $show = $this->Show->read('name', $video['Episode']['show_id']);
            $stage = split(" ", $video['Episode']['name'], 2);
            $tudou_name = $show['Show']['name'] . " " . $stage[0];
            print($tudou_name);

            //print($video['Episode']['name']);
            print("\n");

            try {
                //$results = $this->getEpisode($video['Episode']['name']);
                $results = $this->getEpisode($tudou_name);
                if ($results->page->totalCount < 1) {
                    print($video['Episode']['name'] . " can not be found.\n");
                    continue;
                }
                $this->insertIntoEpisode($results->results[0], $video['Episode']['id']);
            } catch(Exception $e) {
                print("there is something wrong in http get, lets pass it.\n");
                print($e);
                continue;
            }
        }

    }

    private function checkEpisodeIfHasBeenFound($episode_id) {
        return empty($this->Episode->read('youku_id' , $episode_id)['Episode']['youku_id']);
    }

    private function getVideos($from_no) {
        return $this->Episode->find('all', array(
            'conditions'=>array(
                'Episode.id >=' => $from_no
            )
        ));
    }

    private function getEpisode($youku_name) {
        $url = "http://api.tudou.com/v6/video/search";
        $data = array(
            'app_key' => 'dcef104a61864e63',
            'format' => 'json',
            'kw' => $youku_name
        );
        App::uses('HttpSocket', 'Network/Http');
        $HttpSocket = new HttpSocket();
        $results = $HttpSocket->get($url, array($data));
        $response = json_decode($results->body);

        return $response;
    }

    private function insertIntoEpisode($episode, $episode_id){
        print($episode->title);
        print("\n");
        print("\n");
        $this->Episode->updateAll(
            array(
                'Episode.tudou_name' => "'$episode->title'",
                'Episode.tudou_id' => "'$episode->itemCode'",
                'Episode.description' => "'$episode->description'",
            ),
            array('Episode.id' => $episode_id)
        );
    }
}
