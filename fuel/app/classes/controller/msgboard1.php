<?php

class Controller_Msgboard1 extends Controller_Template
{
	public function before(){
        parent::before();

        if (Auth::check()) {
            $this->template->login = true;
        } else {
            $this->template->login = false;
            $this->template->user =  Model_Account::find($id);
        }
    }

	public function get_index()
	{
		$msgs = Model_Msgboard::find('all',[
            'order_by' => [
                'updated_at' => 'desc',
                'created_at' => 'desc',
            ]
        ]);
        $style = ['w3-pale-blue w3-border-blue', 'w3-pale-green w3-border-teal', 'w3-pale-yellow w3-border-yellow'];
        $bg = ['w3-black', 'w3-white'];

		$data = ['login' => $this->login, 'msgs' => $msgs, 'style' => $style, 'bg' => $bg];
        if ($this->login) {
            $data['user'] = $this->user;
        }
        $this->template->login = $this->login;
		$this->template->title = '留言板';
		$this->template->content = View::forge('msgboard/index', $data);
	}

	public function get_add()
	{
		$data = ['login' => false];
        $this->template->login = false;
        $this->template->title = '留下訊息...';
        $this->template->content = View::forge('msgboard/add', $data);
	}

    public function post_add()
    {
        $msgboard = new Model_Msgboard();
        $msgboard->title = Input::post('title');
        $msgboard->message = Input::post('message');
            
        // Auth
        if($this->login) {
            $msgboard->account_id = $this->user->id;
            $msgboard->account = $this->user;
        } else {
            $msgboard->account_id = 0;
        }
            // 自訂此上傳的配置
            $config = array(
                'path' => './assets/img/uploads',
                'randomize' => true,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );

            // 處理 $_FILES 中上傳的檔案
            Upload::process($config);

            if(Upload::get_files(0)){
                // 如果有任何有效檔案
                if (Upload::is_valid())
                {
                    Upload::save();
                    $file = Upload::get_files(0);

                    // 呼叫一個模型方法來更新資料庫
                    $upload = new Model_Upload();
                    $upload->name = $file['name'];
                    $upload->extension = $file['extension'];
                    $upload->saved_as = $file['saved_as'];
                    $upload->saved_to = $file['saved_to'];
                    $msgboard->upload = $upload;
                    $msgboard->save();
                }
                else{
                    Session::set_flash('failed','上傳圖片有誤');
                    Response::redirect('add');
                }
            }

        if($msgboard->save()) {
            Session::set_flash('success','Message 新增成功');
            Response::redirect('/');
        }

        $this->template->login = $this->login;
        $this->template->title = 'Adding...';
        $this->template->content = VIew::forge('msgboard/add',$data);
    }

	public function post_editMessage()
	{
        if(!$this->login) return Response::redirect('/');

        $id = Input::post('id');
        
        $msg = Model_Msgboard::find($id);
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
            $msg->save();
            Session::set_flash('success', '編輯成功');
        } else {
            Session::set_flash('failed', '編輯錯誤');
        }
        return Response::redirect('/');
	}

	public function post_deleteMessage()
	{
        if(!$this->login) return Response::redirect('/');

        $id = Input::post('id');
        $msg = Model_Msgboard::find($id);
        if($msg) {
            if(!$this->user->admin && $this->user->id != $msg->account_id) {
                Session::set_flash('failed', '這不是你發的文!');
                return Response::redirect('/');
            }

            #先刪除圖片與解除關係
            $pic = $msg->upload;
            $msg->upload = null;
            if($pic){
                if(!File::delete($pic->saved_to.$pic->saved_as)) {
                Session::set_flash('failed','圖片刪除失敗');
                return Response::redirect('/');
                }
                $pic->delete();
            }
            
            #再刪除每個關聯回覆
            $replies = $msg->replies;
            unset($msg->replies);
            foreach ($replies as $reply) {
                $reply->delete();
            }

            #最後刪除留言
            $msg->delete();
            Session::set_flash('success','Message 刪除成功');
        } else {
            Session::set_flash('failed','Message 刪除失敗');
        }
        Response::redirect('/');
	}

	public function get_belongUser()
	{
        if(!$this->login) return Response::redirect('login');
        
		$msgs = Model_Msgboard::find('all',[
            'where' => ['account_id' => $this->user->id ],
            'order_by' => ['updated_at'=>'desc']
        ]);

        $style = ['w3-pale-blue w3-border-blue', 'w3-pale-green w3-border-teal', 'w3-pale-yellow w3-border-yellow'];
        $bg = ['w3-black', 'w3-white'];

        $data = ['login' => $this->login, 'msgs' => $msgs, 'style' => $style, 'bg' => $bg];
        $data['user'] = $this->user;
        
        $this->template->login = $this->login;
        $this->template->title = '我的留言板';
        $this->template->content = View::forge('msgboard/index', $data);
	}

	public function get_view()
	{
        $id = $this->param('id');
        if($this->login && ($this->user->id == $id)) { 
            return Response::redirect('belong');
        }

        $person = Model_Account::find($id);

        if(!$person) {
            Session::set_flash('failed', 'No Person'.$id);
            return Response::redirect('/');
        }        

        $msgs = Model_Msgboard::find('all',[
            'where' => ['account_id' => $person->id ],
            'order_by' => ['updated_at'=>'desc']
        ]);


        $style = ['w3-pale-blue w3-border-blue', 'w3-pale-green w3-border-teal', 'w3-pale-yellow w3-border-yellow'];
        $bg = ['w3-black', 'w3-white'];

        $data = ['login' => $this->login, 'msgs' => $msgs, 'style' => $style, 'bg' => $bg];
        if($this->login) {
            $data['user'] = $this->user;
        }

        $this->template->login = $this->login;
        $this->template->title = $person->name.'的留言板';
        $this->template->content = View::forge('msgboard/index', $data);        

	}

    public function action_404()
    {
        $this->template->login = $this->login;
        $this->template->title = '此頁面不存在，看看史努比';
        $this->template->content = VIew::forge('msgboard/404');
    }

}
