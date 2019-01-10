<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $table = 'log';

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

    public function User()
    {
        return $this->belongsTo('App\User','user_id','id')
            ->withDefault([
                'nickname'=>'该账户已注销',
                'username'=>'Unknown',
                'email'=>''
            ]);
    }

    static public function getLog(){
        return self::with('User')->orderBy('id','desc')->paginate(15);
    }
}
