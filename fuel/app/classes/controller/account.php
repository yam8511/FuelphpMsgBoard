<?php
/**
 * The file
 */

/**
 * Class Controller_Account
 */
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
		$this->template->content = View::forge('user/register', $data);
	}

	public function post_register()
	{
		$act = new Model_Account();
        $data = [];

        if(Input::post('send')){

            $act->name = Input::post('username');
            $act->password = sha1(Input::post('password'));
            $act->email = Input::post('email');
            $data['act'] = $act;

            $user_exist =  Model_Account::find('first', [
                'where' => ['name' => Input::post('username') ]
            ]);
            $email_exist =  Model_Account::find('first', [
                'where' => ['email' => Input::post('email') ]
            ]);

            if($user_exist){
                Session::set_flash('hint_username', '此帳戶已存在');
            }
            if($email_exist){
                Session::set_flash('hint_email', '此Email已註冊過');
            }
            if(!$user_exist && !$email_exist){
            	$act->admin = 0;
                $act->save();
                Session::set_flash('success','加入會員成功:)');
                Response::redirect('/');
            }
            Session::set_flash('username', Input::post('username'));
            Session::set_flash('email', Input::post('email'));
        }

		$this->template->login = $this->login;
        $this->template->title = '加入會員';
		$this->template->content = View::forge('user/register', $data);
	}

	public function get_login()
	{
        if($this->login) return Response::redirect('/');
        $this->template->login = false;
        $this->template->title = '登入';
        $this->template->content = View::forge('user/login');
	}
	public function post_login()
	{
            $user = Model_Account::find('first',[
                'where'=>[
                    'name' => Input::post('username'),
                ]
            ]);

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
                    Session::set_flash('username', $user->name);
                }
            }
            else{
                Session::set_flash('warning','此帳戶尚未建立');
            }

        $this->template->login = false;
        $this->template->title = '登入';
        $this->template->content = View::forge('user/login');
	}

	public function get_logout()
	{
		Cookie::delete('user');
        Response::redirect('/');
	}

}
