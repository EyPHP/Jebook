<?php
/**
 * IndexController.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 16:04
 */

namespace App\Http\Controllers\Admin;

use App\User;

class IndexController extends BaseController
{
    public function index(){
        $adminInfo = session('adminInfo');
        return view('admin/admin',['adminInfo'=>$adminInfo]);
    }

    /**
     * 面板
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(){
        $userCount = User::all()->count();
        return view('admin/welcome',['userCount'=>$userCount]);
    }
}