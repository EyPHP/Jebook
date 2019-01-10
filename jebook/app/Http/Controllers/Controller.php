<?php

namespace App\Http\Controllers;

use App\BlackIp;
use App\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    /**
     * ajax响应格式
     * @var array
     */
    public $ajaxRresponseData = [
        'data' => '',
        'msg' => 'Success.',
        'code' => 200
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {
        /*if(!isset($request->zmkm) && $request->zmkm != 1){
            header("Content-type: text/html; charset=utf-8");
            die('网站暂未开放。');
        }*/

        //获取UA信息
        $ua = $_SERVER['HTTP_USER_AGENT'];

        //将恶意USER_AGENT存入数组
        $now_ua = array('FeedDemon ','BOT/0.1 (BOT for JCE)','CrawlDaddy ','Java','Feedly','UniversalFeedParser','ApacheBench','Swiftbot','ZmEu','Indy Library','oBot','jaunty','YandexBot','AhrefsBot','MJ12bot','WinHttp','EasouSpider','HttpClient','Microsoft URL Control','YYSpider','jaunty','Python-urllib','lightDeckReports Bot');
        //禁止空USER_AGENT，dedecms等主流采集程序都是空USER_AGENT，部分sql注入工具也是空USER_AGENT
        if(!$ua) {
            header("Content-type: text/html; charset=utf-8");
            die('请勿采集本站，因为采集的站长木有小JJ！');
        }else {
            //判断是否是数组中存在的UA
            if (in_array($ua,$now_ua)) {
                header("Content-type: text/html; charset=utf-8");
                die('请勿采集本站，因为采集的站长木有小JJ！');
            }

        }



        if (!$request->is('admin/*')) {

            $logModel = new Log();
            $logModel->model = $request->url();
            $logModel->method = $request->getMethod();
            $logModel->data = json_encode($request->all());

            if (($request->path() == 'login.html' || $request->path() == 'register.html') && $logModel->method == 'POST') {
                $logModel->data = json_encode(array('data' => '数据保密'));
            }

            $logModel->ip = $_SERVER['REMOTE_ADDR'];

            $res = BlackIp::where(['ip' => $logModel->ip])->first();
            if ($res) {
                echo '你过于频繁访问。请稍后重试';
                die;
            }

            $this->middleware(function ($request, $next) use($logModel) {
                $userInfo = $request->session()->get('userInfo');

                if ($userInfo){
                    $logModel->user_id = $userInfo['id'];
                }

                $logModel->save();

                return $next($request);
            });




        }
    }


}
