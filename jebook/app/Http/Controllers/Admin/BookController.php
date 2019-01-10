<?php
/**
 * BookController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 10:01
 */
namespace App\Http\Controllers\Admin;

use App\Article;
use App\Book;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends BaseController
{
    public function lst(){
        $bookModel = new Book();
        $count = $bookModel->count();
        $bookData = $bookModel->getUserList();
        return view('admin.book.booklist',['data'=>$bookData,'count'=>$count]);
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

        $bookModel = Book::with('User')->find($request->id);
        if(!$bookModel){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '非法操作';
            return response()->json($this->ajaxRresponseData);die;
        }
        if($bookModel->User->email == ''){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '创建人不存在，不能审核';
            return response()->json($this->ajaxRresponseData);die;
        }
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

        $email = $bookModel->User->email;
        if($bookModel->status == 1){
            $title = '恭喜，你在Jebook新建的项目 '.$bookModel->book_name.' 审核通过';
            $param = [
                'url' => $bookModel->domain,
                'username' => $bookModel->User->nickname,
                'name' => $bookModel->book_name,
                'title' => $title
            ];
            $temp = 'mail.bookAudit';
        }else{
            $title = '你好，你在Jebook新建的项目 '.$bookModel->book_name.' 待完善';
            $param = [
                'username' => $bookModel->User->nickname,
                'name' => $bookModel->book_name,
                'reason' => $bookModel->reason,
                'title' => $title
            ];
            $temp = 'mail.bookAuditFaild';
        }


        MailController::send($title,$email,$param,$temp);
        return response()->json($this->ajaxRresponseData);die;
    }

    /**
     * 审核视图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auditview(Request $request){
        $bookModel = Book::with('User')->find($request->id);
        return view('admin.book.auditview',['bookModel'=>$bookModel]);
    }

    /**
     * 书籍详细信息
     * @param Request $request
     */
    public function info(Request $request){
        $book_id = $request->get('book_id');
        if(!$request->get('book_id')){
            echo '请先选择书籍.';die;
        }

        // 书籍信息
        $book = Book::find($book_id);
        /*var_dump($book_id);die;*/
        $count = Article::where(['book_id'=>$book_id])->count();
        $chapter = Article::treeChapter($book_id);
        /*echo '<pre>';
        var_dump($chapter);die;*/

        return view('admin.book.chapter',['data'=>$chapter,'book_name'=>$book->book_name,'count'=>$count]);

    }
}