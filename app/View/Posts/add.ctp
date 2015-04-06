<!-- File: /app/View/Posts/add.ctp -->
<?php echo $this->Form->create('Post', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well'
));?>

    <fieldset>
        <h2>New Post</h2>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('body', array('rows' => '25'));
            echo $this->Form->submit('Submit', array(
                'div' => 'form-group',
                'class' => 'btn btn-default'
            ));
       ?>
    <fieldset>
<?php echo $this->Form->end(); ?>
