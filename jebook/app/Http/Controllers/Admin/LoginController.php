<?php
/**
 * Login.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 10:08
 */

namespace App\Http\Controllers\Admin;


use App\Admin;
use App\Http\Controllers\Controller;
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

            if(!$request->post('password') || !$request->post('username')){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '邮箱或者密码不能为空。';
                return response()->json($this->ajaxRresponseData);die;
            }

            $adminModel = new Admin();

            $res = $adminModel->where(['username'=>$request->post('username')])->first();
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
            session(['adminInfo'=>$res]);

            return response()->json($this->ajaxRresponseData);die;
        }

        $admin = $request->admin;
        if($admin != 'chenli'){
            return redirect('/');
        }
        return view('admin/login');
    }

    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        session(['adminInfo'=>null]);
        return redirect('/');
    }
}