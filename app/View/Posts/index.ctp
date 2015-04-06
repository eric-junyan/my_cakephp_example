<!-- File: /app/View/Posts/index.ctp -->
<?php echo $this->Html->css('justified-top');?>
<div class="container">
    <div class="jumbotron">
        <h1>Blog posts</h1>
        <p class="lead">You can try to post some blogs here.</p>
        <p><?php echo $this->Html->link(
            'Go to Post',
            array(
                'controller' => 'posts',
                'action' => 'add'
            ),
            array(
                'class' => array('btn','btn-lg', 'btn-success'),
                'role' => 'button'
            )
       ); ?></p>
    </div>

    <div class="row-fluid">
        <?php foreach ($posts as $post): ?>
            <div class="col-sm-6 col-md-4 col-lg-4">
              <div class = "thumbnail">
                  <h2 class="text-center"><?php echo $post['Post']['title']; ?></h2>
                  <p class="blog-time"><?php echo date('Y/m/d H:i:s', $post['Post']['created_at']); ?></p>
                  <p class="blog-text"><?php echo substr(h($post['Post']['body']), 0, 200); ?></p>
                  <p><?php 
                  echo $this->Html->link("View details >>",
                      array(
                          'action' => 'view',
                          '#' => $post['Post']['id']
                      ),
                      array(
                          'class' => array('btn', 'btn-primary'),
                          'role' => 'button'
                      ));
                  ?></p>
              </div>
            </div>
        <?php endforeach; ?>
        <?php unset($post); ?>
    </div>
    <?php echo $this->Paginator->pagination(array(
        'div' => array('pagination', 'pagination-centered')
    )); ?>
</div>
