<?php
use App\Core\form\Form;
use App\Core\form\TextareaField;

$this->title = 'Contact';

?>

<h1>
    Contact
</h1>

<?php $form = Form::begin('', 'post'); ?>

    <?= $form->field($model,'subject'); ?>
    <?= $form->field($model,'email'); ?>
    <?= new TextareaField($model,'body'); ?>
    <button type="submit" class="btn btn-primary">Submit</button>

<?php Form::end(); ?>

