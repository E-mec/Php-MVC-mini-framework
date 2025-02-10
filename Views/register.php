<h1>
    Register
</h1>

<?php $form = \App\Core\form\Form::begin('', 'post') ; ?>

    <div class="row">
        <div class="col">
        <?php echo $form->field($model,'fName') ?>
        </div>
        <div class="col">
        <?php echo $form->field($model,'lName') ?>
        </div>
    </div>
    <?php echo $form->field($model,'email')->emailField() ?>
    <?php echo $form->field($model,'password')->passwordField() ; ?>
    <?php echo $form->field($model,'c_password')->passwordField() ; ?>

    <button type="submit" class="btn btn-primary">Submit</button>


<?php \App\Core\form\Form::end() ; ?>


   