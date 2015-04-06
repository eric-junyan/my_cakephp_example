<!-- File: /app/View/Posts/edit.ctp -->
<?php echo $this->Form->create('Post', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => array('input-large', 'form-control')
    ),
    'class' => 'well'
));?>

    <fieldset>
        <h2>Edit Post</h2>
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
