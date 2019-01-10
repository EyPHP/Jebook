<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $table = 'user';

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
}
