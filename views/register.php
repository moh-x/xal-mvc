<?php use app\core\form\Form; ?>

<h1 class="my-4">Create account</h1>

<?php $form = Form::begin('', 'post') ?>
<!--    TODO: Use the enum or Field::TEXT_TYPE  -->
    <?= $form->field($model, 'fullname', 'text') ?>
    <?= $form->field($model, 'email', 'email') ?>
    <?= $form->field($model, 'password', 'password') ?>
    <?= $form->field($model, 'confirmPassword', 'password') ?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>

<!--<form action="" method="post">-->
<!---->
<!--    <div class="form-group mb-3">-->
<!--        <label for="fullname" class="form-label">Full Name</label>-->
<!--        <input type="text" name="fullname" value="<?//= $model->fullname ?>" id="fullname"-->
<!--               class="form-control <?//= $model->hasError('fullname') ? 'is-invalid' : '' ?>" >-->
<!--        <div class="invalid-feedback"><?//= $model->getFirstError('fullname') ?></div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-group mb-3">-->
<!--        <label for="email" class="form-label">Email address</label>-->
<!--        <input type="email" name="email" class="form-control" id="email">-->
<!--    </div>-->
<!---->
<!--    <div class="form-group mb-3">-->
<!--        <label for="password" class="form-label">Password</label>-->
<!--        <input type="password" name="password" class="form-control" id="password">-->
<!--    </div>-->
<!---->
<!--    <div class="form-group mb-3">-->
<!--        <label for="confirmPassword" class="form-label">Confirm Password</label>-->
<!--        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">-->
<!--    </div>-->
<!---->
<!--    <button type="submit" class="btn btn-primary">Submit</button>-->
<!---->
<!--</form>-->