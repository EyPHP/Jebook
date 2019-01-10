<?php
/**
 * ArticleController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-04 17:30
 */

namespace App\Http\Controllers;


use App\Article;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends AuthController
{
    /**
     * 文章详情
     */
    public function info(){
        //$build = new BuildController();
        // md文件生成
        //$build->build();
    }
    /**
     * 文章编辑
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(Request $request){

        $book_id = $request->get('book_id');
        $id = $request->get('id');
        if(!$book_id){
            echo '请先选中书籍！';die;
        }
        $bookModel = Book::find($book_id);
        if(!$bookModel){
            echo '书籍不存在！';die;
        }
        if($bookModel->status == 0){
            echo '书籍待审核！';die;
        }
        if($bookModel->status == 2){
            echo '书籍审核未通过！';die;
        }

        // 书的模型
        $articleModel = null;
        if($id) {
            $articleModel = Article::with('Book')->find($id);
        }
        /*echo '<pre>';
        var_dump($articleModel);die;*/

        // 书籍目录
        $chapter = Article::getChapter($book_id);

        return view('app/article/editor',['bookModel'=>$bookModel,'book_id'=>$book_id,'articleModel' =>$articleModel,'chapter'=>$chapter]);
    }

    /**
     * 文章保存
     * @return \Illuminate\Http\JsonResponse\
     */
    public function save(Request $request){
        $id = $request->post('id');
        $articleModel = null;

        if($id){
            $articleModel = Article::find($id);
            $type = $articleModel->type;
        }
        if(!$articleModel){
            $articleModel = new Article();
        }

        $book_id = $request->post('book_id');

        $content = $request->post('text');
        $title = $request->post('title');

        $res = Article::where(['title'=>$title,'book_id'=>$book_id])->first();
        if($res && !$id){
            $this->ajaxRresponseData['code'] = '500';
            $this->ajaxRresponseData['msg'] = '改书已经存在同样的章节';
            return response()->json($this->ajaxRresponseData);exit;
        }
        if(!$book_id || !$content || !$title){
            $this->ajaxRresponseData['code'] = '500';
            $this->ajaxRresponseData['msg'] = 'Book ID OR ARTICLE CONTENT OR TITLE IS NULL';
            return response()->json($this->ajaxRresponseData);exit;
        }

        $articleModel->path = $request->post('path');
        if(!$articleModel->path){
            $articleModel->path = '';
        }


        $res = explode("/",  $articleModel->path);
        if(count($res)>3){
            $this->ajaxRresponseData['code'] = '500';
            $this->ajaxRresponseData['msg'] = '目录最多3级';
            return response()->json($this->ajaxRresponseData);exit;
        }

        $userInfo = session('userInfo');

        $articleModel->book_id = $book_id;
        $articleModel->user_id = $userInfo['id'];
        $articleModel->content = $content;
        $articleModel->title = $title;
        $articleModel->desc = $request->post('desc');
        $articleModel->keywords = $request->post('keywords');

        $userType = $request->post('type');

        if($userType){
            $type = $userType;
        }else{
            $type = 0;
        }

        $articleModel->type = $type;
        if(!$articleModel->save()){
            $this->ajaxRresponseData['code'] = 500;
            $this->ajaxRresponseData['msg'] = '保存失败';
            return response()->json($this->ajaxRresponseData);die;
        }

        if($type == 1){
            if($articleModel->path == ''){
                $articleModel->path = DS;
            }
            $build = new BuildController($articleModel->book_id);
            // md文件生成
            $bool1 = $build->buildMd($articleModel->path,$articleModel->title,$articleModel->content);

            // 重新生成目录
            $build->buildChapterSummary($articleModel->book_id);
            // 生成静态网页
            $bool2 = $build->buildChapter($build->path);
            // 可加队列
            if(!$bool1 || !$bool2){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '发布失败.';
                return response()->json($this->ajaxRresponseData);
            }
            //return response()->json($this->ajaxRresponseData);
        }

        $this->ajaxRresponseData['data'] = array('id' => $articleModel->id);
        return response()->json($this->ajaxRresponseData);
    }
}