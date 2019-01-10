<?php
/**
 * Book.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-07 11:45
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $table = 'book';

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
     * 关联User
     * @return $this
     */
    public function User()
    {
        return $this->belongsTo('App\User','user_id','id')
            ->withDefault([
                'nickname'=>'该账户已注销',
                'username'=>'Unknown',
                'email'=>''
            ]);
    }

    /**
     * 关联章节
     */
    public function Article(){
        return $this->hasMany('App\Article');
    }

    /**
     * 获取列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserList(){
        return $this->with('User')->orderBy('id','desc')->paginate(15);
    }

    /**
     * 根据条件获取列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    static public function getUserListByWhere($where = [], $limit = 20){
        if($where){
            return self::with('User')->where($where)->orderBy('id','desc')->paginate($limit);
        }
        return self::with('User')->orderBy('id','desc')->paginate($limit);
    }

    /**
     * 获取个人书籍列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserListByUserID($user_id,$limit = 5){
        return $this->with('User')->where(['user_id'=>$user_id])->orderBy('id','desc')->paginate($limit);
    }

}