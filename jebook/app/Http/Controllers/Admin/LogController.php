<?php
/**
 * IndexController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 16:04
 */

namespace App\Http\Controllers\Admin;
use App\Log;

class LogController extends BaseController
{
    public function lst(){
        $data = Log::getLog();
        $count = Log::count();
        return view('admin/log/lst',['data'=>$data,'count'=>$count]);
    }
}