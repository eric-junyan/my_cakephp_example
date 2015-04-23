<?php echo $this->Html->css('animeshow');?>
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-3">
           <img class="poster img-responsive" alt="Responsive image" src="<?php echo $show['Show']['image_url'] ?>">
        </div>
        <div class="col-sm-9">
        <h2 class="js-title"><?php echo $show['Show']['name'] ?></h2>
            <h4 class="js-sub-title"></h4>
            <h5 class="js-release-date show-sub-info"><?php echo $show['Show']['released_at'] ?></h5>
            <h5 class="js-update-episode show-sub-info">共<?php echo $show['Show']['episode_total'] ?>集</h5>
            <h5 class="js-update-date show-sub-info"></h5>
            <!--p class="js-directors">导演: </p>
            <p class="js-voices">声优: </p>
            <p class="js-writers">编剧: </p-->
            <p class="js-description"><?php echo $show['Show']['description'] ?></p>
        </div>
    </div>
    <div class="col-sm-12" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
              <li role="presentation" class=""><a href="#youku" id="youku-tab" role="tab" data-toggle="tab" aria-controls="youku" aria-expanded="false">优库</a></li>
              <li role="presentation" class=""><a href="#tudou" role="tab" id="tudou-tab" data-toggle="tab" aria-controls="tudou" aria-expanded="false">土豆</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade" id="youku" aria-labelledby="youku-tab">
                  <div class="row js-row">
                      <?php foreach ($videos as $video): ?>
                          <a class='col-sm-4 col-md-3 col-lg-3' target="view_frame" href="/prototype/youkuvideo/<?php echo $video['Episode']['id'] ?>">
                              <div class = "thumbnail">
                                  <img src="<?php echo $video['Episode']['image_url'] ?>">
                                  <p><?php echo $video['Episode']['name'] ?></p>
                              </div>
                         </a>
                      <?php endforeach; ?>
                      <?php unset($video); ?>
                  </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="tudou" aria-labelledby="tudou-tab">
                  <div class="row js-row">
                      <?php foreach ($videos as $video): ?>
                          <a class='col-sm-4 col-md-3 col-lg-3' target="view_frame" href="/prototype/tudouvideo/<?php echo $video['Episode']['id'] ?>">
                              <div class = "thumbnail">
                                  <img src="<?php echo $video['Episode']['image_url'] ?>">
                                  <p><?php echo $video['Episode']['tudou_name'] ?></p>
                              </div>
                         </a>
                      <?php endforeach; ?>
                      <?php unset($video); ?>
                  </div>
              </div>
        </div>
                <!--nav>
           <ul class="pagination">
               <li>
                   <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                   </a>
               </li>
               <li class="active"><a class="js-pager" href="#">1</a></li>
               <li><a class="js-pager" href="#">2</a></li>
               <li><a class="js-pager" href="#">3</a></li>
               <li><a class="js-pager" href="#">4</a></li>
               <li><a class="js-pager" href="#">5</a></li>
               <li>
                   <a href="#" aria-label="Next">
                       <span aria-hidden="true">&raquo;</span>
                   </a>
               </li>
            </ul>
         </nav-->
     </div>
</div>
