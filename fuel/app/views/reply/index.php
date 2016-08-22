<?php
/**
 * Created by PhpStorm.
 * User: yam8511_li
 * Date: 2016/8/17
 * Time: 下午 03:28
 */
?>
<?php $root = '/FuelphpMsgBoard/public/'; ?>
<div class="w3-container w3-margin-bottom">
    <ul class="w3-ul w3-card-4">
        <!-- 回覆列表 -->
        <?php $index = 0; foreach( $msg->replies as $rpl ): ?>
        <li class="w3-container <?= $bg[($index++) % 2] ?>">
            <div class="w3-container">
                <span class="w3-large"><a style="text-decoration: none;" href="/view/<?= $rpl->account_id ?>"><?= $rpl->user($rpl->account_id)->name ?></a></span>　　
                <span class="w3-small w3-text-grey"><?= $rpl->updated_at ?></span><br>
                <span><?= nl2br($rpl->message) ?></span>
            </div>
            <!-- 修改&刪除按鈕 -->
            <div class="w3-container w3-padding">
                <?php if( $login && ( $rpl->account_id == $user->id ) ): ?>
                    <a class="w3-btn w3-round w3-purple" title="修改" onclick="show('modal_edit_rpl_<?= $rpl->id ?>')"><i class="fa
        	        fa-pencil"></i></a>
                    <!-- 顯示編輯視窗 -->
                    <?= View::forge('modal_edit', ['type' => 'rpl', 'msg' => $rpl]) ?>
                <?php endif; ?>
                <?php if( $login && ( $rpl->account_id == $user->id || $user->admin)): ?>
                    <a class="w3-btn w3-round w3-red" title="刪除" onclick="show('modal_delete_rpl_<?= $rpl->id ?>')"><i class="fa fa-trash"></i></a>
                    <!-- 顯示刪除提醒視窗 -->
                    <?= View::forge('modal_delete', ['type' => 'rpl', 'msg' => $rpl]) ?>
                <?php endif; ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- 回覆輸入 -->
<form action="<?= $root ?>reply" method="post" accept-charset="UTF-8">
    <div class="w3-row-padding">
        <div class="w3-col m10">
            <?php if($login) { ?>
                <textarea name="message" rows="1" style="width: 100%; resize: none;" class="auto-height w3-hover-border-cyan" placeholder="輸入內容" required></textarea>
            <?php } else { ?>
                <textarea name="message"  rows="1" style="resize:none; width: 100%;" class="auto-height w3-hover-border-cyan" placeholder="請先登入，才能回覆" readonly></textarea>
            <?php } ?>
            <input type="hidden" name="msg_id" value="<?= $msg->id ?>">
        </div>
        <div class="w3-col m2">
            <button style="width: 100%;" class="w3-btn w3-round-large w3-teal">回覆</button>
        </div>
    </div>
</form>
