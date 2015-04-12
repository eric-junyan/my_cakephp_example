<div class="container">
    <div class="starter-template">
        <h1 class = "js-video-title"></h1>
        <p class="lead">source from youku </p>
        <div id="youkuplayer" align="middle" style="width:800px;height:400px"></div>
        <script type="text/javascript" src="http://player.youku.com/jsapi">
           player = new YKU.Player('youkuplayer',{
               styleid: '0',
               client_id: '987302dd59060846',
               vid: '<?php echo $vid ?>'
           });
        </script>
    </div>
</div>
<script>
$(document).ready(function() {
    $.get("https://openapi.youku.com/v2/videos/show_basic.json",
        {
            'client_id':'987302dd59060846',
            'video_id': '<?php echo $vid ?>'
        },
        function(data){
            $(".js-video-title").text(data.title);
        }
    );
});
</script>
