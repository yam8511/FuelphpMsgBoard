<div id="modal_register" class="w3-modal" style="z-index: 900;">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-pink">
            <span onclick="document.getElementById('modal_register').style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-user"></i>註冊</h2>
        </header>
        <?= View::forge('user/register') ?>
    </div>
</div>
