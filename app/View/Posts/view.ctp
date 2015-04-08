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
     /**
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
                   **/
               echo $this->Form->create( 'Post', array( 'type'=>'post' ) );
               echo $this->Form->input('id', array( 'value' => $post['Post']['id'], 'type' => 'hidden'));
               echo $this->Js->submit( 'Delete', array(
                   'confirm' => 'Are you sure?',
                   'class' => array('btn', 'btn-danger', 'blog-post-btn'),
                   //'success' => $this->Js->get( '#sending-js-submit' )->effect( 'fadeOut' ), // => success (Local Event)
                   //  'error' =>                       // => error (Local Event)
                   //  'complete' =>                    // => complete (Local Event)
                   'url' => '/posts/delete',        // Ajax処理で呼び出すURL(controller/action)
                   'update' => '#row'               // ajax更新の結果を出力する要素
               ) );
               echo $this->Form->end();
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

<!-- File: /app/View/Posts/edit.ctp -->
<?php echo $this->Form->create('Post', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => array('input-large', 'form-control')
    ),
    'class' => 'well'
));?>

    <fieldset class="invisible">
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('body', array('rows' => '25'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            echo $this->Form->submit('Post Submit', array(
                'div' => 'form-group',
                'class' => 'btn btn-default'
            ));
       ?>
    <fieldset>
<?php echo $this->Form->end(); ?>
