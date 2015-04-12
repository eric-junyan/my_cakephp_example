<?php echo $this->Html->css('animeshow');?>
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-3">
           <img class="js-poster">
        </div>
        <div class="col-sm-9">
            <h2 class="js-title"></h2>
            <h4 class="js-sub-title"></h4>
            <h5 class="js-release-date show-sub-info"></h5>
            <h5 class="js-update-episode show-sub-info"></h5>
            <h5 class="js-update-date show-sub-info"></h5>
            <p class="js-directors">导演: </p>
            <p class="js-voices">声优: </p>
            <p class="js-writers">编剧: </p>
            <p class="js-description"></p>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row js-row">
        </div>
        <nav>
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
         </nav>
     </div>
</div>
<script>
    $(document).ready(function() {
        $.get("https://openapi.youku.com/v2/shows/show.json",
            {
               'client_id':'987302dd59060846',
               'show_id':'<?php echo $sid ?>'
            },
            function(data){
                $(".js-title").text(data.name);
                $(".js-sub-title").text(data.subtitle);
                $(".js-release-date").text(data.released + "发布");
                $(".js-update-episode").text("更新到第" + data.episode_updated + "集");
                $(".js-update-date").text(data.update_notice);
                $(".js-description").text(data.description);
                $(".js-poster").attr('src', data.poster_large);
                $.each(data.attr.director, function(){
                    $(".js-directors").append('<a href="'+this.link+'">'+this.name+'</a> ');
                });
                $.each(data.attr.voice, function(){
                    $(".js-voices").append('<a href="'+this.link+'">'+this.name+'</a> ');
                });
                $.each(data.attr.screenwriter, function(){
                    $(".js-writers").append('<a href="'+this.link+'">'+this.name+'</a> ');
                });
            }
        );
        makeVideoList(1);

        $(".js-pager").each(function(){
            var page_no = $(this).text();
            $(this).bind("click", function(){
                makeVideoList(page_no);
                $("li.active").removeClass("active");
                $(this).parent().addClass("active");
            });
        });
    });

    function makeVideoList(page) {
        $(".js-row").empty();
        $.get("https://openapi.youku.com/v2/shows/videos.json",
            {
               'client_id':'987302dd59060846',
               'show_id':'<?php echo $sid ?>',
               'page': page,
               'count': 22,
               'orderby': 'videoseq-desc'
            },
            function(data){
                $.each(data.videos, function(){
                    var url = "/demo/youkuvideo/" + this.id;
                    var name = "第" + this.stage + "集";
                    $(".js-row").append("<a class='btn btn-default col-sm-2 col-md-1 col-lg-1' href=" + url + " role='button'>" + name + "</a>");
                });
            }
        );
    }
</script>

