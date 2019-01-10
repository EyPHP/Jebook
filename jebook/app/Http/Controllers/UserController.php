<?php
/**
 * UserController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-12 9:04
 */

namespace App\Http\Controllers;


use App\Article;
use App\Book;
use App\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public $sex = [
        1 => '女',
        2 => '男'
    ];
    public function personalCenter(){
        $userInfo = session('userInfo');
        $userModel = User::find($userInfo['id']);
        $count = Book::where('user_id',$userInfo['id'])->count();
        $sigin = true;
        if(strtotime($userModel->update_time)+3600>time()){
            $sigin = false;
        }
        return view('app.user.personalCenter',['userModel'=>$userModel,'count'=>$count,'sex'=>$this->sex,'sigin'=>$sigin]);
    }

    /**
     * 用户中心书籍类别
     */
    public function bookList(){
        $userInfo = session('userInfo');
        $bookModel = new Book();
        $count = Book::where('user_id',$userInfo['id'])->count();
        $bookData = $bookModel->getUserListByUserID($userInfo['id']);
        return view('app.user.booklist',['data'=>$bookData,'count'=>$count]);
    }

    /**
     * 签到
     */
    public function signIn(){

        $userInfo = session('userInfo');
        $userModel = User::find($userInfo['id']);
        if(strtotime($userModel->update_time)+3600>time()){
            $this->ajaxRresponseData['data'] = ['time'=>$userModel->update_time];
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '今天已经签到过了';
            return response()->json($this->ajaxRresponseData);die;
        }
        $userModel->integral += 2;

        $userModel->level = floor(sqrt(($userModel->integral)+3));
        //$userModel->update_time = time();
        if($userModel->save()){
            $this->ajaxRresponseData['data'] = ['integral'=>$userModel->integral,'level'=>$userModel->level,'time'=>$userModel->update_time];
            $this->ajaxRresponseData['msg'] = '签到成功';
            return response()->json($this->ajaxRresponseData);die;
        }
        $this->ajaxRresponseData['code'] = 500;
        $this->ajaxRresponseData['msg'] = '签到失败';
        return response()->json($this->ajaxRresponseData);die;

    }

    /**
     * 设置书籍权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function isPublic(Request $request){
        $book_id = $request->book_id;
        if(!$book_id){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '请先选择书籍';
            return response()->json($this->ajaxRresponseData);die;
        }

        $bookModel = Book::find($book_id);
        if($bookModel->public == 1){
            $bookModel->public = 2;
        }else{
            $bookModel->public = 1;
        }
        if($bookModel->save()){
            $this->ajaxRresponseData['msg'] = '设置成功.';
            return response()->json($this->ajaxRresponseData);die;
        }
        $this->ajaxRresponseData['code'] = 500;
        $this->ajaxRresponseData['msg'] = '设置失败';
        return response()->json($this->ajaxRresponseData);die;
    }

    /**
     * 书籍详细信息
     * @param Request $request
     */
    public function chapter(Request $request){

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

        return view('app.user.chapter',['data'=>$chapter,'book_name'=>$book->book_name,'count'=>$count,'book_id'=>$book_id]);

    }


}