/**
 * Created by zoular_li on 2016/8/11.
 */
function validate()
{
    var OK = true;
    var pass = document.registerForm.password;
    var confirm = document.registerForm.confirm;

    if(pass.value != confirm.value)
    {
        document.getElementById('hint_confirm').innerHTML = '密碼輸入不一樣';
        OK = false;
    }

    var email = document.registerForm.email;
    if(!email.checkValidity()){
        document.getElementById('hint_email').innerHTML = email.validationMessage;
        OK = false;
    }

    return OK;
}