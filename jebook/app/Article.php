<?php
/**
 * Article.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-07 11:55
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $table = 'article';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * 格式化时间
     * @param \DateTime|int $value
     * @return false|int
     */
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }

    /**
     * 关联书模型
     * @return $this
     */
    public function Book()
    {
        return $this->belongsTo('App\Book', 'book_id', 'id')
            ->withDefault([
                'book_id' => '',
                'book_name' => 'Unknown',
            ]);
    }

    /**
     * 获取书的章节
     * @param $book_id
     * @return mixed
     */
    static public function getChapter($book_id)
    {
        $res = self::where('book_id', $book_id)->get(['path']);
        $chapter = [];
        foreach ($res as $val) {
            if (!in_array($val, $chapter)) {
                $chapter[] = $val;
            }
        }
        return $chapter;
    }

    /**
     * 获取章节详细信息
     * @param $book_id
     * @return mixed
     */
    static public function getChapterInfo($book_id)
    {
        $res = self::where('book_id', $book_id)->get();

        return $res;


    }



    /**
     * 无限级目录
     * @return array
     */
    static public function treeChapter($book_id)
    {
        $res = self::getChapter($book_id);

        $val = self::getChapterInfo($book_id);

        $chapter = [];
        foreach ($res as $k => $v) {

            $res = explode("/", $v->path);

            if (count($res) < 2) {
                $parent = '';
            } else {
                $parent = $res[count($res) - 2];
            }

            if(count($res) == 1 && $res[count($res)-1] == ""){
                $id = 'null';
            }else{
                $id = $res[count($res) - 1];
            }

            $chapterV = [];
            foreach ($val as $key => $value){
                $res1 = explode("/", $value->path);

                if(count($res1) == 1 && $res1[count($res1)-1] == ""){
                    $id1 = 'null';
                }else{
                    $id1 = $res1[count($res1) - 1];
                }
                
                if($id1 == $id){
                    // 章节数据
                    $chapterV[] = $value;
                }

            }


            $data['data'] = $chapterV;

            $data['pid'] = $parent;
            $data['id'] = $id;

            $chapter[] = $data;
        }

        return self::makeTree($chapter,'');

    }


    /**
     * 递归章节
     * @param $arr
     * @param string $pid
     * @return array
     */
    static public function makeTree($arr, $pid = '')
    {

        foreach ($arr as $k => $v) {
            if ($v['pid'] == $pid) {
                $data[$v['id']] = $v;
                $data[$v['id']]['sub'] = self::makeTree($arr, $v['id']);
            }
        }
        return isset($data) ? $data : array();
    }
}