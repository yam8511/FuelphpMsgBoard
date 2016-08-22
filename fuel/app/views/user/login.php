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
            <?= Form::label("帳號",'username',['class'=>'w3-label']) ?>
            <?= Form::input('username', Session::get_flash('username'), ['class'=>'w3-input w3-hover-border-cyan','required']) ?>
            <?= Form::label("密碼",'password',['class'=>'w3-label']) ?>
            <?= Form::input('password', '', ['class'=>'w3-input w3-hover-border-cyan','required','type'=>'password']) ?>
            <p class="hint" id="hint_login"></p>
            <?= Form::submit('login','登入',['class'=>'w3-btn w3-blue w3-ripple']) ?>
        </div>
        <?= Form::close(); ?>
    </div>
</div>

<?= View::forge('modal_register') ?>