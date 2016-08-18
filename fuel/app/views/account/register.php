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
        <?= Form::open(['name'=>'registerForm','action'=>'register','method'=>'post']) ?>
        <div class="w3-form  w3-margin ">
            <?= Form::label("帳號",'name',['class'=>'w3-label']) ?>
            <?= Form::input('name', isset($act)? $act->name : '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的帳戶','required']) ?>
            <p id="hint_name" class="hint"><?= $hint_user ?></p>

            <?= Form::label("密碼",'password',['class'=>'w3-label']) ?>
            <?= Form::input('password', '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的密碼','required','type'=>'password']) ?>
            <p id="hint_password" class="hint"></p>

            <?= Form::label("確認密碼",'confirm',['class'=>'w3-label']) ?>
            <?= Form::input('confirm', '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'確認密碼','required','type'=>'password']) ?>
            <p id="hint_confirm" class="hint"></p>
            <?= Form::label("E-mail",'email',['class'=>'w3-label']) ?>
            <?= Form::input('email', isset($act)? $act->email : '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的E-mail', 'type'=>'email','required']) ?>
            <p id="hint_email" class="hint"><?= $hint_email ?></p>
            <?= Form::submit('send','註冊',['class'=>'w3-btn w3-pink w3-ripple']) ?>
        </div>
        <?= Form::close(); ?>
    </div>
</div>

<?= Asset::js('validate.js') ?>