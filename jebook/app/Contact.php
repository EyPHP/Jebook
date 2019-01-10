<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $table = 'contact';

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

    static public function getMessage(){
        return self::orderBy('id','desc')->paginate(15);
    }
}
