<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/11
 * Time: 下午 12:29
 */
?>


<div class="w3-container">

    <div class="w3-card-4">
        <?= Form::open(['name'=>'registerForm','action'=>'login','method'=>'post']) ?>
        <div class="w3-form  w3-margin ">
            <?= Form::label("帳號",'name',['class'=>'w3-label']) ?>
            <?= Form::input('name', isset($act)? $act->name : '', ['class'=>'w3-input w3-hover-border-cyan','required']) ?>
            <?= Form::label("密碼",'password',['class'=>'w3-label']) ?>
            <?= Form::input('password', '', ['class'=>'w3-input w3-hover-border-cyan','required','type'=>'password']) ?>
            <p class="hint" id="hint_login"></p>
            <?= Form::submit('login','登入',['class'=>'w3-btn w3-blue w3-ripple']) ?>
        </div>
        <?= Form::close(); ?>
    </div>
</div>

<div id="modal_register" class="w3-modal" style="z-index: 900;">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-pink">
            <span onclick="document.getElementById('modal_register').style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-user"></i>註冊</h2>
        </header>
        <div class="w3-container">
            <?= Form::open(['name'=>'registerForm','action'=>'register','method'=>'post','onsubmit'=>'return validate()']) ?>
            <div class="w3-form  w3-margin ">
                <?= Form::label("帳號",'name',['class'=>'w3-label']) ?>
                <?= Form::input('name', Input::post(isset($act)? $act->name : ''), ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的帳戶','required']) ?>
                <p id="hint_username" class="hint"></p>

                <?= Form::label("密碼",'password',['class'=>'w3-label']) ?>
                <?= Form::input('password', Input::post(isset($act)? $act->password : ''), ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的密碼','required','type'=>'password']) ?>
                <p id="hint_password" class="hint"></p>

                <?= Form::label("確認密碼",'comfirm',['class'=>'w3-label']) ?>
                <?= Form::input('confirm', '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'確認密碼','required','type'=>'password']) ?>
                <p id="hint_confirm" class="hint"></p>
                <?= Form::label("E-mail",'email',['class'=>'w3-label']) ?>
                <?= Form::input('email', '', ['class'=>'w3-input w3-hover-border-cyan','placeholder'=>'您的E-mail', 'type'=>'email','required']) ?>
                <p id="hint_email" class="hint"></p>
                <?= Form::submit('send','註冊',['class'=>'w3-btn w3-pink w3-ripple']) ?>
            </div>
            <?= Form::close(); ?>
        </div>
    </div>
</div>

<?= Asset::js('validate.js') ?>