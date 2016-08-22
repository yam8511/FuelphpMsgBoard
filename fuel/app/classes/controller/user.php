<?php

class Controller_User extends Controller_Template
{

	public function before(){
        parent::before();
        $this->template->login = Auth::check();
    }

	public function get_register()
	{
		if (Auth::check()) {
			return Response::redirect_back('/');
		}

		$this->template->title = '加入會員';
		$this->template->content = View::forge('user/register');
	}

	public function post_register()
	{
		$username = Input::post('username');
		$password = Input::post('password');
		$email = Input::post('email');

		try {
			$created = Auth::create_user($username, $password, $email);
			if ($created) {
				Session::set_flash('success','加入會員成功:)');
                return Response::redirect_back('/');
			} else {
				Session::set_flash('error','加入會員失敗:(');
			}
		} catch(SimpleUserUpdateException $e) {
			Session::set_flash('username', Input::post('username'));
            Session::set_flash('email', Input::post('email'));

			if($e->getCode() == 2) {
				Session::set_flash('hint_email', '此Email已註冊過');
			} elseif($e->getCode() == 3) {
				Session::set_flash('hint_username', '此帳戶已存在');
			} else { 
				Session::set_flash('failed', $e->getMessage());
			}
		}
		
		//$this->template->content = View::forge('user/register');
	}

	public function get_login()
	{
		if (Auth::check()) {
			return Response::redirect_back('/');
		}

        $this->template->title = '登入';
        $this->template->content = View::forge('user/login');
	}
	public function post_login()
	{
        $username = Input::post('username');
		$password = Input::post('password');
		if (Auth::login($username, $password)) {
			Session::set_flash('success','登入成功:)');
            return Response::redirect_back('/');
		} else {
			Session::set_flash('failed','登入失敗，請確認帳號密碼:(');
		}

        //$this->template->title = '登入';
        //$this->template->content = View::forge('user/login', $data);
	}

	public function get_logout()
	{
		Auth::logout();
        Response::redirect('/');
	}

}
