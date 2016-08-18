<?php

class Controller_Account extends Controller_Template
{
    private $user = null;
    private $login = false;

    public function before(){
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

	public function get_register()
	{
        $data = ['hint_user'=>'','hint_email'=>''];
		$this->template->login = $this->login;
		$this->template->title = '加入會員';
		$this->template->content = View::forge('account/register', $data);
	}

	public function post_register()
	{
		$act = new Model_Account();
        $data = ['hint_user'=>'','hint_email'=>''];

        if(Input::post('send')){

            $act->name = Input::post('name');
            $act->password = sha1(Input::post('password'));
            $act->email = Input::post('email');
            $data['act'] = $act;

            $user_exist =  Model_Account::find('first', [
                'where' => ['name' => Input::post('name') ]
            ]);
            $email_exist =  Model_Account::find('first', [
                'where' => ['email' => Input::post('email') ]
            ]);

            if($user_exist){
                $data['hint_user'] = '此帳戶已存在';
            }
            elseif($email_exist){
                $data['hint_email'] = '此Email已註冊過';
            }
            else{
            	$act->admin = 0;
                $act->save();
                Session::set_flash('success','加入會員成功:)');
                Response::redirect('/');

            }
        }

		$this->template->login = $this->login;
        $this->template->title = '加入會員';
		$this->template->content = View::forge('account/register', $data);
	}

	public function get_login()
	{
        if($this->login) return Response::redirect('/');
        $this->template->login = false;
        $this->template->title = '登入';
        $this->template->content = View::forge('account/login');
	}
	public function post_login()
	{
            $user = Model_Account::find('first',[
                'where'=>[
                    'name'=>Input::post('name'),
                ]
            ]);

	        $data = [];

            if($user)
            {
                if($user->password == sha1(Input::post('password')))
                {
                    Session::set_flash('success','Login Success as '.$user->name);
                    Cookie::set('user',$user->id,60*60*24*30);
                    Response::redirect('/');
                }
                else{
                    Session::set_flash('failed','帳號密碼錯誤');
                    $data['act'] = $user;
                }
            }
            else{
                Session::set_flash('warning','此帳戶尚未建立');
            }

        $this->template->login = false;
        $this->template->title = '登入';
        $this->template->content = View::forge('account/login', $data);
	}

	public function get_logout()
	{
		Cookie::delete('user');
        Response::redirect('/');
	}

}
