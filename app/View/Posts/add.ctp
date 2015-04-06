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
        <legend>Post</legend>
        <?php
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->submit('Submit', array(
    'div' => 'form-group',
    'class' => 'btn btn-default'

));
?>

    <fieldset>
<?php echo $this->Form->end(); ?>
