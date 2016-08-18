<?php

class Controller_Reply extends Controller_Template
{
	private $user = null;
    private $login = false;

	public function before() {
		parent::before();
		
		if(Cookie::get('user'))
        {
        	$id = Cookie::get('user');
            $this->template->user =  Model_Account::find($id);
            $this->template->login = true;
            $this->login = true;
            $this->user = Model_Account::find($id);
        }
        else{
            $this->login = false;
            $this->user = null;
        }
	}

	public function post_addReply()
	{
		if(!$this->login) {
			return Response::redirect('login');
		}

		$message = Input::post('message');

		if ($message == '') {
            return redirect('/');
        }

        $msg = Model_Msgboard::find(Input::post('msg_id'));
        if(!$msg) {
            Session::set_flash('failed', '回覆發生錯誤');
            return redirect('/');
        }

        $rpl = new Model_Reply();
        $rpl->message = $message;
        $rpl->msgboard_id = $msg->id;
        $rpl->account_id = $this->user->id;
        $rpl->msgboard = $msg;
        if(!$rpl->save()) {
            Session::set_flash('failed', '回覆發生錯誤');
            return Response::redirect('/');
        }
        Session::set_flash('success', '回覆成功');
        return Response::redirect('/');
	}

	public function post_editReply()
	{
		if(!$this->login) return Response::redirect('/');

        $id = Input::post('id');
        
        $msg = Model_Reply::find($id);
        if($msg) {
            if($this->user->id != $msg->account_id) {
                Session::set_flash('failed', '這不是你發的文!');
                return Response::redirect('/');
            }

            $origin_msg = preg_replace('/\s(?=)/', '', trim($msg->message));
            $new_msg = preg_replace('/\s(?=)/', '', trim(Input::post('message')));

            if($origin_msg == $new_msg) {
                return Response::redirect('/');
            }

            $msg->message = Input::post('message');
            date_default_timezone_set('Asia/Taipei');
            $msg->updated_at = DB::expr('default');
            $msg->save();
            Session::set_flash('success', 'Reply 編輯成功');
        } else {
            Session::set_flash('failed', 'Reply 編輯錯誤');
        }
        return Response::redirect('/');
	}

	public function post_deleteReply()
	{
		if(!$this->login) return Response::redirect('/');

		$rpl = Model_Reply::find(Input::post('id'));
        if($rpl) {
        	if($this->user->id != $rpl->account_id) {
                Session::set_flash('failed', '這不是你發的文!');
                return Response::redirect('/');
            }
            $rpl->delete();
            Session::set_flash('success', 'Reply 刪除成功');
        } else {
            Session::set_flash('failed', 'Reply 刪除失敗');
        }
        return Response::redirect('/');
	}

}
