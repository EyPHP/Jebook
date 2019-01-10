<?php
/**
 * IndexControllers.php
 * Created by PhpStorm.
 * User: chenli
 * Time: 2018-10-09 14:34
 */

namespace App\Http\Controllers;


use App\Book;
use App\Contact;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function welcome(){
        $userCount = User::all()->count();
        return view('welcome',['userCount'=>$userCount+325]);
    }

    /**
     * 日志
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function log(){
        return view('app/updatelog');
    }

    /**
     * 案例
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jeCase(){
        $where = ['public'=>1];
        $bookList = Book::getUserListByWhere($where);
        return view('app/case',['bookList'=>$bookList]);
    }

    /**
     * 联系我们
     */
    public function contactUs(){
        $data = Contact::where(['static'=>1])->get();
        $count = Contact::where(['static'=>1])->count();

        return view('app/contact',['data'=>$data,'count'=>$count]);
    }

    /**
     * 留言
     */
    public function add(Request $request){

        if($request->getMethod() == 'POST'){
            $contact = new Contact();
            $contact->name = $request->post('name');
            if(!$contact->name){
                $contact->name = '一位不愿透露姓名高人';
            }
            $contact->content = $request->post('content');
            $contact->static = 0;
            if(!$contact->content){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '内容不能为空';
                return response()->json($this->ajaxRresponseData);die;
            }
            if(!$contact->save()){
                $this->ajaxRresponseData['code'] = 500;
                $this->ajaxRresponseData['msg'] = '留言失败！';
                return response()->json($this->ajaxRresponseData);die;
            }

            return response()->json($this->ajaxRresponseData);die;
        }
    }
    /**
     * 关于我们
     */
    public function about(){
        $weatherInfo = cache('weatherInfo');
        if(!$weatherInfo) {
            $data = $this->getWeatherInfo();
            $weatherInfo = json_decode($data);
            cache(['weatherInfo' => $weatherInfo], 8*60);
        }
        /*echo '<pre>';
        var_dump($weatherInfo->showapi_res_body);die;*/
        return view('app/about',['weatherInfo'=>$weatherInfo->showapi_res_body]);
    }


    /**
     * 天气预报接口
     * @return mixed
     */
    public function getWeatherInfo(){
        $host = "http://saweather.market.alicloudapi.com";
        $path = "/ip-to-weather";
        $method = "GET";
        $appcode = "be0183fab60d4e53ae2f52586e7fa7a7";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "ip={$_SERVER['REMOTE_ADDR']}&need3HourForcast=0&needAlarm=0&needHourData=0&needIndex=0&needMoreDay=1";

        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    /**
     * 新闻列表
     * @return mixed
     */
    public function news(){
        return view('app/news');
    }

    /**
     * 新闻详情
     * @return mixed
     */
    public function details(Request $request){
        $id = $request->get('id');
        return view("app/news/details-{$id}");
    }

}