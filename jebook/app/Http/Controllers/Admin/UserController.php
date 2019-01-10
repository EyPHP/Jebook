<?php
/**
 * BookController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 10:01
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BuildController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    public function lst(){
        $userData = User::orderBy('id','desc')->paginate(15);
        $count = User::count();
        /*echo '<pre>';
        var_dump($userData);die;*/
        return view('admin.user.userlist',['data'=>$userData,'count'=>$count]);
    }

    /**
     * 审核
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function audit(Request $request){

        if(!$request->id || !$request->domain || !$request->status || !$request->desc ){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '非法操作';
            return response()->json($this->ajaxRresponseData);die;
        }

        $bookModel = Book::find($request->id);

        $bookModel->status = $request->status;
        $bookModel->domain = $request->domain;
        $bookModel->reason = $request->desc;
        $bookModel->audit_time = time();

        DB::beginTransaction();
        if(!$bookModel->save()){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = 'save faild.';
        }

        if($bookModel->status == 1) {
            // 审核成功后创建书籍
            $build = new BuildController($request->id);
            $res = $build->build($bookModel->path, $bookModel->domain);
            if (!$res) {
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = 'create book faild.';
                DB::rollBack();
            }
        }
        DB::commit();
        return response()->json($this->ajaxRresponseData);die;
    }

    public function auditview(Request $request){
        $bookModel = Book::find($request->id);
        return view('admin.book.auditview',['bookModel'=>$bookModel]);
    }

    public function setUserStatus(Request $request){

        if(!$request->id || $request->status === ''){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '非法操作';
            return response()->json($this->ajaxRresponseData);die;
        }

        $bookModel = User::find($request->id);
        if(!$bookModel){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '操作失败';
            return response()->json($this->ajaxRresponseData);
            die;
        }

        $bookModel->status = $request->status;
        if (!$bookModel->save()) {
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '操作失败';
            return response()->json($this->ajaxRresponseData);
            die;
            return response()->json($this->ajaxRresponseData);die;
        }

        return response()->json($this->ajaxRresponseData);die;
    }
}