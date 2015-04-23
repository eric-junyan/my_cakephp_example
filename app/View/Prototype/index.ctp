<?php echo $this->Html->css('animetop');?>
<?php echo $this->Html->css('animecolumn');?>
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
        <?php foreach ($shows as $show): ?>
        <div class="list-group-item js-show-column js-sample col-sm-12 col-md-12 col-lg-12" onClick="window.open('/prototype/show/<?php echo $show['Show']['id']?>')">
                <div class="image-block col-sm-2 col-md-2 col-lg-2" >
                    <image class="js-show-icon" src="<?php echo $show['Show']['image_url']?>">
                </div>
                <div class="text-block col-sm-10 col-md-10 col-lg-10" >
                      <h4 class="js-show-title show-title"><?php echo $show['Show']['name']?></h2>
                      <p class="js-show-description"><?php echo $show['Show']['description']?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <?php unset($show); ?>
    </div>
    <?php echo $this->Paginator->pagination(array(
        'div' => array('pagination', 'pagination-centered')
    )); ?>
</div>
<div class="invisible">
    <?php echo $this->element('animecolumn'); ?>
</div>
<script>
    $(document).ready(function() {
    });

    $(".js-show-search-btn").click(function(){
        makeShowList( $(".js-show-search-input").val() );
    });

    function makeShowList(keyword) {
         $.get("/prototype/search",
            {
               'keyword':keyword
            },
            function(data){
                $(".pagination").remove();
                $(".js-row").empty();
                var jsonObj = typeof(data) === "object" ? data : $.parseJSON(data);
                $.each(jsonObj.shows, function(){
                    $(".js-show-column.js-sample").clone().removeClass("js-sample").appendTo(".js-row");
                    $(".js-row").children().last().find(".js-show-title").text(this.Show.name);
                    $(".js-row").children().last().find(".js-show-description").text(this.Show.description.substr(0,200));
                    $(".js-row").children().last().find(".js-show-icon").attr('src',this.Show.image_url);
                    var show_url = "/prototype/show/" + this.Show.id;
                    $(".js-row").children().last().bind("click", function(){
                        window.open(show_url);
                    })
                });
            }
        );
    }
</script>
