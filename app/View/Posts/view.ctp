<!-- File: /app/View/Posts/view.ctp -->
<?php echo $this->Html->css('blog');?>

<div class="container">
    <div class="blog-header">
       <h1 class="blog-title">The Blogs</h1>
       <p class="lead blog-description">You can read, edit or delete blogs here.</p>
    </div>

    <div class="row">
        <div class="col-sm-3 bs-docs-sidebar" id="scroll-spy">
              <ul class="nav nav-list bs-docs-sidenav" data-spy="affix" data-offset-top="125">
                  <?php foreach ($posts as $post): ?>
                      <li>
                         <?php echo $this->Html->link(
                              h($this->Html->useTag('i', array("class" => "icon-chevron-right")) .$post['Post']['title']),
                              '#' . $post['Post']['id']
                          );?>
                     </li>
                  <?php endforeach?>
              </ul>
        </div>
        <div class="col-sm-9 blog-main">
        <?php foreach ($posts as $post): ?>
         <section id=<?php echo ($post['Post']['id']); ?> >
           <div class="blog-post">
             <div class="page-header">
               <h2 class="blog-post-title"><?php echo h($post['Post']['title']); ?></h2>
             </div>
               <p class="blog-post-meta">Created At  <?php echo date('Y/m/d H:i:s', $post['Post']['created_at']); ?>  &nbsp; &nbsp; Updated At  <?php echo date('Y/m/d H:i:s', $post['Post']['created_at']); ?></p>
               <p><?php echo h($post['Post']['body']); ?></p>
               <p> <?php
                   echo $this->Form->postLink("Delete",
                       array(
                           'action' => 'delete',
                           $post['Post']['id']
                       ),
                       array(
                           'class' => array('btn', 'btn-danger', 'blog-post-btn'),
                           'role' => 'button',
                           'confirm' => 'Are you sure?'
                       )
                   );
                   echo $this->Html->link("Edit",
                       array(
                           'action' => 'edit',
                           $post['Post']['id']
                       ),
                       array(
                           'class' => array('btn', 'btn-success', 'blog-post-btn'),
                           'role' => 'button',
                       )
                   );

               ?></p>
           </div>
         </section>
        <?php endforeach?>
        </div>
    </div>
</div>
