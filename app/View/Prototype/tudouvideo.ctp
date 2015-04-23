<div class="container">
    <div class="starter-template">
    <h1 class = "video-title"><?php echo $video['Episode']['tudou_name']?></h1>
        <p class="lead">source from tudou </p>
        <iframe
            src="http://www.tudou.com/programs/view/html5embed.action?code=<?php echo $video['Episode']['tudou_id'] ?>&autoPlay=false&playType=AUTO"
            width="100%"
            height="524px"
            frameborder="0"
            scrolling="no"
        ></iframe>
    </div>
</div>
