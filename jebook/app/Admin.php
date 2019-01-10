<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    protected $table = 'admin';

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
