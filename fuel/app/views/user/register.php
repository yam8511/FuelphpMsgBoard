<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/10
 * Time: 下午 04:54
 */
?>
<div class="w3-container">
    <div class="w3-card-4">
        <?= Form::open(['name'=>'registerForm','action'=>'register','method'=>'post', 'onsubmit' => 'return validate()']) ?>
        <div class="w3-form  w3-margin ">
            <?= Form::label("帳號",'username',['class'=>'w3-label']) ?>
            <?= Form::input('username', Session::get_flash('username'), ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的帳戶','required']) ?>
            <p id="hint_username" class="hint"><?= Session::get_flash('hint_username') ?></p>

            <?= Form::label("密碼",'password',['class'=>'w3-label']) ?>
            <?= Form::input('password', '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的密碼','required','type'=>'password']) ?>
            <p id="hint_password1" class="hint"></p>

            <?= Form::label("確認密碼",'confirm',['class'=>'w3-label']) ?>
            <?= Form::input('confirm', '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'確認密碼','required','type'=>'password']) ?>
            <p id="hint_password" class="hint"></p>
            <?= Form::label("E-mail",'email',['class'=>'w3-label']) ?>
            <?= Form::input('email', Session::get_flash('email'), ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的E-mail', 'type'=>'email','required']) ?>
            <p id="hint_email" class="hint"><?= Session::get_flash('hint_email') ?></p>
            <?= Form::submit('send','註冊',['class'=>'w3-btn w3-pink w3-ripple']) ?>
        </div>
        <?= Form::close(); ?>
    </div>
</div>

<?= Asset::js('validate.js') ?>