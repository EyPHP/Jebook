<?php
/**
 * IndexController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 16:04
 */

namespace App\Http\Controllers\Admin;


use App\Contact;
use Illuminate\Http\Request;


class ContactController extends BaseController
{
    /**
     * 留言列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lst(){
        $data = Contact::getMessage();
        $count = Contact::count();
        return view('admin/contact/lst',['data'=>$data,'count'=>$count]);
    }

    /**
     * 删除留言
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request){
        $bool = Contact::destroy($request->id);
        if(!$bool){
            $this->ajaxRresponseData['code'] = '500';
            $this->ajaxRresponseData['msg'] = '失败';
            return response()->json($this->ajaxRresponseData);exit;
        }
        return response()->json($this->ajaxRresponseData);exit;
    }

    /**
     * 回复留言
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function reply(Request $request){

        if($request->getMethod() == 'POST') {
            $replyModel = Contact::find($request->id);

            if(!$replyModel){
                $this->ajaxRresponseData['code'] = '500';
                $this->ajaxRresponseData['msg'] = '失败';
                return response()->json($this->ajaxRresponseData);
                exit;
            }

            $replyModel->reply = $request->reply;

            if(!$replyModel->reply){
                $this->ajaxRresponseData['code'] = '500';
                $this->ajaxRresponseData['msg'] = '失败';
                return response()->json($this->ajaxRresponseData);
                exit;
            }
            if (!$replyModel->save()) {
                $this->ajaxRresponseData['code'] = '500';
                $this->ajaxRresponseData['msg'] = '失败';
                return response()->json($this->ajaxRresponseData);
                exit;
            }

            return response()->json($this->ajaxRresponseData);
            exit;
        }
        return view('admin/contact/reply',['id'=>$request->id]);
    }

    /**
     * 审核留言
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function audit(Request $request){
        $contactModel = Contact::find($request->id);
        $contactModel->static = 1;
        $contactModel->save();
        return response()->json($this->ajaxRresponseData);
    }
}