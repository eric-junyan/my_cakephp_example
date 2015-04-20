<?php

App::uses('File', 'Utility');

class GetEpisodeIdShell extends AppShell {
    public $uses = array('Show', 'Episode');

    public function main() {
        $from_no =  $this->args[0];
        $shows = $this->getShows($from_no);
        foreach($shows as $show) {
            if ($this->checkEpisodeIfSaved($show['Show']['id'])){ continue; }
            print($show['Show']['name'] . " is in searching.\n");
            print($show['Show']['id'] . "\n");
            sleep(5);

            try {
                $results = $this->getEpisode($show['Show']['id'], $show['Show']['youku_id']);
                if ($results->total === 0) {
                    print($show['Show']['name'] . " can not be found.\n");
                    continue;
                }
                $this->insertIntoEpisodes($results->videos, $show['Show']['id']);
            } catch(Exception $e) {
                print("there is something wrong in http get, lets pass it.\n");
                print($e);
                continue;
            }
        }

    }

    private function checkEpisodeIfSaved($show_id) {
        return !empty($this->Episode->findByShowId($show_id));
    }

    private function getShows($from_no) {
        return $this->Show->find('all', array(
            'conditions'=>array(
                'Show.id >=' => $from_no
            )
        ));
    }

    private function getEpisode($show_id, $youku_id) {
        $url = "https://openapi.youku.com/v2/shows/videos.json";
        $data = array(
            'client_id' => '987302dd59060846',
            'show_id' => $youku_id,
            'count' => 100
        );
        App::uses('HttpSocket', 'Network/Http');
        $HttpSocket = new HttpSocket();
        $results = $HttpSocket->get($url, array($data));
        $response = json_decode($results->body);

        $this->Show->updateAll(
            array('Show.episode_total' => $response->total),
            array('Show.id' => $show_id)
        );

        if ($response->total > 100) {
            $turns = ceil($response->total / 100);
            for($i = 1;$i < $turns ; $i++) {
                sleep(4);
                print("In searching Page".($i+1)."\n");
                $extra_data = array(
                    'client_id' => '987302dd59060846',
                    'show_id' => $youku_id,
                    'count' => 100,
                    'page' => $i+1
                );
                $extra_results = $HttpSocket->get($url, array($extra_data));
                $extra_response = json_decode($extra_results->body);
                $response->videos = array_merge($response->videos, $extra_response->videos);
            }
        }
        return $response;
    }

    private function insertIntoEpisodes($episodes, $show_id){
        $set_state_flag = 0;
        foreach($episodes as $episode) {
            $episode_info = array(
                'youku_id' => $episode->id,
                'show_id' => $show_id,
                'name' => $episode->title,
                'youku_state' => $episode->state,
                'duration' => $episode->duration,
                'episode_no' => $episode->stage,
                'image_url' => $episode->thumbnail,
                'released_at' => $episode->published
            );
            $this->Episode->create();
            $this->Episode->save($episode_info);
            if ( $set_state_flag === 0 ) {
                $this->Show->updateAll(
                    array('Show.youku_state' => "'$episode->state'"),
                    array('Show.id' => $show_id)
                );
                $set_state_flag = 1;
            }
        }
    }
}
