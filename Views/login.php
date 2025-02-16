<h1>
    Login
</h1>

<?php $form = \App\Core\form\Form::begin('', 'post') ; ?>

    
    <?php echo $form->field($model,'email')->emailField() ?>
    <?php echo $form->field($model,'password')->passwordField() ; ?>

    <button type="submit" class="btn btn-primary">Submit</button>


<?php \App\Core\form\Form::end() ; ?>


   