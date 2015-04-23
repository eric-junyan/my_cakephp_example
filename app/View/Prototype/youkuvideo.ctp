<div class="container">
    <div class="starter-template">
    <h1 class = "video-title"><?php echo $video['Episode']['name']?></h1>
        <p class="lead">source from youku </p>
        <div id="youkuplayer" align="middle" style="width:800px;height:400px"></div>
        <script type="text/javascript" src="http://player.youku.com/jsapi">
           player = new YKU.Player('youkuplayer',{
               styleid: '0',
               client_id: '987302dd59060846',
               vid: '<?php echo $video['Episode']['youku_id'] ?>'
           });
        </script>
    </div>
</div>
