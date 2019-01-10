<?php
/**
 * Login.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 10:08
 */

namespace App\Http\Controllers\Admin;


use App\BlackIp;
use Illuminate\Http\Request;

class BlackIpController extends BaseController
{
    public function lst(){
        $data = BlackIp::getBlackIpList();
        return view('admin/black/lst',['data'=>$data]);
    }

    public function del(Request $request){
        $bool = BlackIp::destroy($request->id);
        if(!$bool){
            $this->ajaxRresponseData['code'] = '500';
            $this->ajaxRresponseData['msg'] = '失败';
            return response()->json($this->ajaxRresponseData);exit;
        }
        return response()->json($this->ajaxRresponseData);exit;
    }

    public function add(Request $request){
        if($request->getMethod() == 'POST') {
            $blackIpModel = new BlackIp();
            $blackIpModel->ip = $request->ip;
            if (!$blackIpModel->save()) {
                $this->ajaxRresponseData['code'] = '500';
                $this->ajaxRresponseData['msg'] = '失败';
                return response()->json($this->ajaxRresponseData);
                exit;
            }
            return response()->json($this->ajaxRresponseData);
            exit;
        }
        return view('admin/black/add');
    }

}