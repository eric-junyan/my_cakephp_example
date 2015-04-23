<?php

App::uses('File', 'Utility');

class GetEpisodesFromTudouByNameShell extends AppShell {
    public $uses = array('Show', 'Episode');

    public function main() {
        $file = new File('./Command/Input/tudou_extra_list.csv');
        $videos = $file->read();
        $video_array = explode("\n", $videos);
        foreach($video_array as $video) {
            sleep(2);
            try {
                $results = $this->getEpisode($video);
                if ($results->page->totalCount < 1) {
                    print($video . " can not be found.\n");
                    continue;
                }
                $this->insertIntoEpisode($results->results[0]);
            } catch(Exception $e) {
                print("there is something wrong in http get, lets pass it.\n");
                print($e);
                continue;
            }
        }

    }

    private function checkEpisodeIfHasBeenFound($episode_id) {
        return !empty($this->Episode->read('tudou_id' , $episode_id)['Episode']['tudou_id']);
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

    private function insertIntoEpisode($episode){
        $episode_info = array(
            'tudou_id' => $episode->itemCode,
            'show_id' => 0,
            'name' => $episode->title,
            'tudou_name' => $episode->title,
            'description' => $episode->description,
            'image_url' => $episode->picUrl
        );
        $this->Episode->create();
        $this->Episode->save($episode_info);
    }
}
