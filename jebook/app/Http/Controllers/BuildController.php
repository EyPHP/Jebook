<?php
/**
 * BuildController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-04 18:37
 */

namespace App\Http\Controllers;


use App\Article;
use App\Book;
use Illuminate\Support\Facades\Storage;

class BuildController extends AuthController
{
    // nginx静态书的目录
    private $root = null;
    // 静态书的目录
    public $path = null;

    private $bookModel = null;

    public function __construct($book_id = '')
    {
        if($book_id){
            $this->createBookModel($book_id);
        }
        // 书籍的目录
        if($this->bookModel->book_en_name){
            $this->path = $this->bookModel->path;
            $this->root = $this->bookModel->path . DS . '_book';
            if(!is_dir($this->path)) {
                Storage::disk('md')->makeDirectory($this->path);
            }
        }
    }

    /**
     * 创建书的模型
     * @param $book_id
     */
    public function createBookModel($book_id){
        $this->bookModel =  Book::find($book_id);
    }

    /**
     * 发布新书
     */
    public function build($path,$host){
        if(!$path)return;
        if(!$host)return;


        //$content = "cd $path\n/usr/local/node/bin/gitbook build --output=$path";
        $content = "cd $path\n/usr/local/node/bin/gitbook build --output=$path\nsudo systemctl reload nginx";

        $file = fopen("/wwwroot/jebook/public/sh/build.sh","w+");
        fwrite($file,$content);
        fclose($file);


        //$host = $this->bookModel->book_en_name.'.jebook.com';
        $root = $path. DS . '_book';
        $config = <<<EOT
        
# --------------------------------------------------------------------------
# nginx配置文件
# --------------------------------------------------------------------------
 
server {
    listen       80;
    server_name  {$host};
    root   {$root};
    index  index.php index.html index.htm;
    location ~ \.php$ {
        try_files \$uri \$uri /index.php\$is_args\$args;
    }
    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include        fastcgi_params;
    }

    access_log  logs/$host.log  main;
    error_log  logs/$host.log  error;
}

EOT;
        $filename = $host.'.conf';
        Storage::disk('conf')->put($filename, $config);
        if(!Storage::disk('conf')->exists($filename)){
            return false;
        }

        // 执行命令 重启nginx
        exec('/wwwroot/jebook/public/sh/build.sh 2>&1',$arr,$err);

        if($err != 0){
            return false;
        }

        return true;
    }

    /**
     * 章节生成
     * @param $path
     * @return bool
     */
    public function buildChapter($path){

        $content = "cd $path\n/usr/local/node/bin/gitbook build --output=$path";

        $file = fopen("/wwwroot/jebook/public/sh/build.sh","w+");
        fwrite($file,$content);
        fclose($file);

        exec('/wwwroot/jebook/public/sh/build.sh 2>&1',$arr,$err);

        if($err != 0){
            return false;
        }
        return true;

    }

    /**
     * Article 内容
     * @param $articlePath
     * @param $title
     * @param $content
     */
    public function buildMd($articlePath,$title,$content){
        if(!$this->path)return;
        $path = $this->path.DS.$articlePath;
        // 生成文件
        $filename = $path.DS.$title.'.md';
        if(!is_dir($path)){
            Storage::disk('md')->makeDirectory($path);
        }
        Storage::disk('md')->put($filename, $content);
        if(!Storage::disk('md')->exists($filename)){
            return false;
        }
        return true;
    }

    /**
     * 生成Readme文件
     * @param array $options
     * @return bool
     */
    public function buildReadme($options = array()){
        if(!$this->path)return;
        $content = <<<EOT
## {$options['bookName']}

EOT;
        // 生成文件
        $filename = $this->path.DS.'README.md';
        Storage::disk('md')->put($filename, $content);
        if(!Storage::disk('md')->exists($filename)){
            abort(500, 'Error.');
        }
        return true;
    }

    /**
     * 生成Summary文件
     * @param array $options
     * @return bool
     */
    public function buildSummary($options = array()){
        if(!$this->path)return;
        $content = <<<EOT
# Summary

* [{$options['bookName']}](README.md)

EOT;
        // 生成文件
        $filename = $this->path.DS.'SUMMARY.md';
        Storage::disk('md')->put($filename, $content);
        if(!Storage::disk('md')->exists($filename)){
            abort(500, 'Error.');
        }
        return true;
    }

    /**
     * 生成章节目录
     */
    public function buildChapterSummary($book_id){
        /** [第一章](section1/README.md)
        * [第一节](section1/example1.md)
        * [第二节](section1/example2.md)
        * [第二章](section2/README.md)
        * [第一节](section2/example1.md)*/

        $chapter = Article::treeChapter($book_id);

        $content = '';
        foreach ($chapter as $k1 => $val1) {
            if ($k1 != 'null') {
                $content .= <<<EOT
* [$k1]({$val1['data'][0]['path']}/{$val1['data'][0]['title']}.html)\n
EOT;

                foreach ($val1['data'] as $dk1 => $dv1) {
                    $content .= <<<EOT
\t* [$dv1->title]({$dv1['path']}/{$dv1['title']}.html)\n
EOT;

                }

                if (!empty($val1['sub'])) {
                    foreach ($val1['sub'] as $k2 => $val2) {
                        $content .= <<<EOT
\t\t* [$k2]({$val2['data'][0]['path']}/{$val2['data'][0]['title']}.html)\n
EOT;
                        foreach ($val2['data'] as $dk2 => $dv2) {
                            $content .= <<<EOT
\t\t\t* [$dv2->title]({$dv2['path']}/{$dv2['title']}.html)\n
EOT;
                        }
                        if (!empty($val2['sub'])) {
                            foreach ($val2['sub'] as $k3 => $val3) {
                                $content .= <<<EOT
\t\t\t\t* [$k3]({$val3['data'][0]['path']}/{$val3['data'][0]['title']}.html)\n
EOT;
                                foreach ($val3['data'] as $dk3 => $dv3) {
                                    $content .= <<<EOT
\t\t\t\t\t* [$dv3->title]({$dv3['path']}/{$dv3['title']}.html)\n
EOT;
                                }

                                if (!empty($val3['sub'])) {
                                    foreach ($val3['sub'] as $k4 => $val4) {
                                        $content .= <<<EOT
\t\t\t\t\t\t* [$k4]({$val4['data'][0]['path']}/{$val4['data'][0]['title']}.html)\n
EOT;
                                        foreach ($val4['data'] as $dk4 => $dv4) {
                                            $content .= <<<EOT
\t\t\t\t\t\t\t* [$dv4->title]({$dv4['path']}/{$dv4['title']}.html)\n
EOT;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            } else {
                foreach ($val1['data'] as $dk1 => $dv1) {
                    $content .= <<<EOT
* [$dv1->title]({$dv1['path']}/{$dv1['title']}.html)\n
EOT;
                }
            }

        }

        if(!$this->path)return;

        // 生成文件
        $filename = $this->path.DS.'SUMMARY.md';
        $file = fopen($filename,"w+");
        fwrite($file,$content);
        fclose($file);
        return true;

    }


}
