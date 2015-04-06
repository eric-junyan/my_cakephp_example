<!-- File: /app/View/Posts/view.ctp -->
<?php echo $this->Html->css('blog');?>

<div class="container">
    <div class="blog-header">
       <h1 class="blog-title">The Blogs</h1>
       <p class="lead blog-description">You can read, edit or delete blogs here.</p>
    </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
               <h2 class="blog-post-title"><?php echo h($post['Post']['title']); ?></h2>
               <p class="blog-post-meta">Created At  <?php echo date('Y/m/d H:i:s', $post['Post']['created_at']); ?></p>
               <p class="blog-post-meta">Updated At  <?php echo date('Y/m/d H:i:s', $post['Post']['created_at']); ?></p>
               <p><?php echo h($post['Post']['body']); ?></p>
            </div>
        </div>
    </div>
</div>
