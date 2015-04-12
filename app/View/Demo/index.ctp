<?php echo $this->Html->css('animetop');?>
<div class="container">
    <div class="jumbotron">
        <h1>Kanimei</h1>
        <p class="lead">A Demo for Animation feature</p>
        <form class="form-inline">
            <input class="form-control js-show-search-input" placeholder="银魂">
            <p class="btn btn-mini btn-primary js-show-search-btn">Search</p>
        </form>
    </div>

    <div class="list-group js-row">
    </div>
</div>
<div class="invisible">
    <?php echo $this->element('animecolumn'); ?>
</div>
<script>
    $(document).ready(function() {
        makeShowList("火影忍者");
    });

    $(".js-show-search-btn").click(function(){
        makeShowList( $(".js-show-search-input").val() );
    });

    function makeShowList(keyword) {
         $.get("https://openapi.youku.com/v2/searches/show/by_keyword.json",
            {
               'client_id':'987302dd59060846',
               'keyword':keyword
            },
            function(data){
                $(".js-row").empty();
                $.each(data.shows, function(){
                    $(".js-show-column.js-sample").clone().removeClass("js-sample").appendTo(".js-row");
                    $(".js-row").children().last().find(".js-show-title").text(this.name);
                    $(".js-row").children().last().find(".js-show-description").text(this.description.substr(0,200));
                    $(".js-row").children().last().find(".js-show-icon").attr('src',this.poster);
                    var show_url = "/demo/show/" + this.id;
                    $(".js-row").children().last().bind("click", function(){
                        window.open(show_url);
                    })
                });
            }
        );
    }
</script>
