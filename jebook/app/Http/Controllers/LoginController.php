<?php
/**
 * IndexControllers.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 14:34
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public $rules = [
        'captcha' => 'required|captcha',
    ];

    public $message = [
        'captcha.required' => '验证码不能为空',
        'captcha.captcha' => '请输入正确的验证码',
    ];
    public function login(Request $request){

        if($request->getMethod() == 'POST'){
            $validator = Validator::make($request->all(),$this->rules,$this->message);
            if($validator->fails()){
                $this->ajaxRresponseData['code'] = 500;
                $msg = $validator->errors()->messages();
                $this->ajaxRresponseData['msg'] = $msg['captcha'][0];
                return response()->json($this->ajaxRresponseData);die;
            }

            if(!$request->post('password') || !$request->post('email')){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '邮箱或者密码不能为空。';
                return response()->json($this->ajaxRresponseData);die;
            }

            $userModel = new User();

            $res = $userModel->where(['email'=>$request->post('email')])->first();
            if(!$res){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '用户不存在';
                return response()->json($this->ajaxRresponseData);die;
            }

            if($res->password !== md5($request->post('password'))){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '密码错误';
                return response()->json($this->ajaxRresponseData);die;
            }

            /*if($res->verify == 0){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '邮箱未验证禁止登录';
                return response()->json($this->ajaxRresponseData);die;
            }*/

            if($res->status == 0){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '用户已被禁止登录';
                return response()->json($this->ajaxRresponseData);die;
            }
            // 登录成功;
            session(['userInfo'=>$res]);
            $userUri = session('userUri');
            if(!$userUri){
                $userUri = '/';
            }
            $this->ajaxRresponseData['data'] = array('uri'=>$userUri);
            $this->ajaxRresponseData['msg'] = '登录成功';
            return response()->json($this->ajaxRresponseData);die;
        }


        return view('app/login');
    }

    public function register(Request $request){

        if($request->getMethod() == 'POST'){

            $validator = Validator::make($request->all(),$this->rules,$this->message);
            if($validator->fails()){
                $this->ajaxRresponseData['code'] = 500;
                $msg = $validator->errors()->messages();
                $this->ajaxRresponseData['msg'] = $msg['captcha'][0];
                return response()->json($this->ajaxRresponseData);die;
            }

            if(!$request->post('nickname') || !$request->post('username') || !$request->post('password') || !$request->post('email') || !$request->post('repassword')){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '请完整填写用户必填信息。';
                return response()->json($this->ajaxRresponseData);die;
            }

            $bool = preg_match('/^[a-zA-Z]+$/',$request->post('username'));
            if(!$bool){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '英文名称不符合规则。';
                return response()->json($this->ajaxRresponseData);die;
            }

            if(!filter_var($request->post('email'),FILTER_VALIDATE_EMAIL)){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '无效的 email 格式！';
                return response()->json($this->ajaxRresponseData);die;
            }

            if($request->password != $request->repassword){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '两次密码不一致。';
                return response()->json($this->ajaxRresponseData);die;
            }

            $userModel = new User();
            $res = $userModel->where(['email'=>$request->post('email')])->orWhere(['username'=>$request->post('username')])->first();

            if($res){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '邮箱或者英文名称已存在';
                return response()->json($this->ajaxRresponseData);die;
            }

            $userModel->nickname = $request->post('nickname');
            $userModel->username = $request->post('username');
            $userModel->password = md5($request->post('password'));
            $userModel->email = $request->post('email');
            $userModel->sex = $request->post('sex',0);
            //$userModel->level = 1;
            $userModel->integral = 1;
            $userModel->create_time = time();
            $occupation = $request->input('occupation')?:'无';
            $userModel->occupation = $occupation;
            //$userModel->verify = 0;
            //$userModel->status = 1;
            if($userModel->save()){
                session(['userInfo'=>$userModel]);
                $param['username'] = $userModel->nickname;
                $token = base64_encode($userModel->email);
                session(['userToken'=>$token]);
                $param['token'] = 'http://www.jebook.cn/user/activatemail?token='.$token;
                $param['title'] = 'Jebook 注册邮件';
                MailController::send('Jebook 注册邮件',$userModel->email,$param);
                $userUri = session('userUri');
                if(!$userUri){
                    $userUri = '/';
                }
                $this->ajaxRresponseData['data'] = array('uri'=>$userUri);
                $this->ajaxRresponseData['msg'] = '注册成功';
                return response()->json($this->ajaxRresponseData);die;
            }
            // 注册失败
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '注册失败';
            return response()->json($this->ajaxRresponseData);die;

        }

        return view('app/register');
    }

    public function verifyUser(){
        $userInfo = session('userInfo');

        if(!$userInfo['id']){
            return redirect('/');
        }

        $token = base64_encode($userInfo['email']);
        session(['userToken'=>$token]);
        $param['token'] = 'http://www.jebook.cn/user/activatemail?token='.$token;
        $param['username'] = $userInfo['nickname'];
        $param['title'] = $title = 'Jebook 邮箱验证';
        MailController::send($title,$userInfo['email'],$param);
        echo '邮箱发送成功，请注意查收';
    }

    public function verify(Request $request){

        $token = session('userToken');
        session(['userToken'=>null]);
        if(!$request->get('token') || $token != $request->get('token')){
            echo '验证失败！';exit;
        }
        $token = base64_decode($token);
        $userModel = new User();
        $res = $userModel->where(['email'=>$token])->first();
        if(!$res){
            echo '验证失败！';exit;
        }
        $res->verify = 1;
        if(!$res->save()){
            echo '验证失败！';exit;
        }
        // 更新登录信息
        $userInfo = session('userInfo');
        $userInfo['verify'] = 1;
        session(['userInfo'=>$userInfo]);

        $userUri = session('userUri');
        if(!$userUri){
            $userUri = '/';
        }
        return redirect($userUri);
    }

    public function logout(){
        session(['userInfo'=>null]);
        session(['userUri'=>null]);
        return redirect('/');
    }
}