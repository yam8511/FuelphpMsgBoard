
<div id="modal_login" class="w3-modal" style="z-index: 900;">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-blue">
            <span onclick="document.getElementById('modal_login').style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-user"></i>登入</h2>
        </header>
        <div class="w3-container">
            <?= Form::open(['name'=>'loginForm','action'=>'account/login','method'=>'post']) ?>
                <div class="w3-form  w3-margin ">
                    <?= Form::label("帳號",'name',['class'=>'w3-label']) ?>
                    <?= Form::input('name', Input::post(isset($act)? $act->name : ''), ['class'=>'w3-input w3-hover-border-cyan','required']) ?>
                    <?= Form::label("密碼",'password',['class'=>'w3-label']) ?>
                    <?= Form::input('password', '', ['class'=>'w3-input w3-hover-border-cyan','required','type'=>'password']) ?>
                    <p class="hint" id="hint_login"></p>
                   <?= Form::submit('login','登入',['class'=>'w3-btn w3-blue w3-ripple']) ?>
                </div>
            <?= Form::close(); ?>
        </div>
    </div>
</div>