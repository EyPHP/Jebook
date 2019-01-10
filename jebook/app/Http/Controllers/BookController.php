<?php
/**
 * BookController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-04 17:30
 */

namespace App\Http\Controllers;



use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends AuthController
{

    /**
     * 创建一本书
     */
    public function create(){
        return view('app/book/create',['userInfo'=>$this->userInfo]);
    }

    public function save(Request $request){
        /*var_dump($this->userInfo);die;*/
        //$this->ajaxRresponseData['data'] = $request->post('book');

        // 接收参数
        $data = $request->post('book');
        // 创建项目插进数据库
        $bookModel = new Book();

        // 是否已经存在
        $res = $bookModel->where(['book_en_name'=>$data['book_en_name']])->first();
        if($res){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = 'book name is exist.';
            return response()->json($this->ajaxRresponseData);die;
        }

        $bookModel->user_id = $this->userInfo['id'];
        $bookModel->book_name =  $data['book_name'];
        $bookModel->book_en_name =  $data['book_en_name'];
        $bookModel->readme =  $data['readme'];
        $bookModel->summary =  $data['summary'];
        $bookModel->audit_time = 0;
        $bookModel->reason = '';
        $bookModel->domain = $data['book_en_name'].'.jebook.cn' ;
        $bookModel->path = $this->rootPath . DS. $this->userInfo['username'] . DS . $data['book_en_name'];
        if(!$data['book_name'] || !$data['book_en_name'] || !$data['readme'] || !$data['summary']){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = 'Please verify that data is complete.';
            return response()->json($this->ajaxRresponseData);die;
        }
        // 开启事务
        DB::beginTransaction();
        if($bookModel->save()) {
            // 创建文件
            $build = new BuildController($bookModel->id);
            $options = [
                'bookName' => $bookModel->book_name,
            ];
            $readres = $build->buildReadme($options);
            $summaryres = $build->buildSummary($options);
            if(!$readres || !$summaryres){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = 'create faild.';
                // 失败事务回滚
                DB::rollBack();
            }
        }
        // 提交事务
        DB::commit();
        $title = 'Jebook 您有一本书带审核。';

        MailController::send($title,'491126240@qq.com',array('title'=>$title),'mail.audit');

        return response()->json($this->ajaxRresponseData);die;
    }
}