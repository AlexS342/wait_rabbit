<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Captcha;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;

class ReviewController extends Controller
{
    public function index(Request $request): View|Application|Factory|ContractsApplication
    {
        session_start();

        if(empty($request->sort)){
            $reviews = Review::where('id', '!=', 0)->orderByDesc('created_at')->paginate(5);
            return view('guestbook', ['reviews' => $reviews]);
        }

        $sort = explode('-', $request->sort, 2);

        if($sort[1] === 'more'){
            $reviews = Review::where('id', '!=', 0)->orderBy($sort[0])->paginate(5);
        }else{
            $reviews = Review::where('id', '!=', 0)->orderByDesc($sort[0])->paginate(5);
        }

        return view('guestbook', ['reviews' => $reviews]);
    }
    public function captcha()
    {
        $captcha = new Captcha();
        session(['code' => $captcha->getCode()]);
        $captcha->render();
    }

    public function create(ReviewRequest $request)
    {
        $value = $request->session()->pull('code');
        if($request['user_captcha'] !== $value){
            return back()->with('message', 'Вы неверно ввели проверочный код ' . $request['user_captcha'] . ' !== ' . $value);
        }

        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $browser = $_SERVER['HTTP_USER_AGENT'];
//        $browser = $_SERVER['HTTP_SEC_CH_UA'];

        $data = $request->all();
        unset($data['_token']);

        $review = Review::create([
            ... $data,
            'ip' => $ip,
            'browser' => $browser
        ]);

        $reviews = Review::all();
        return redirect()->route('review', ['reviews' => $reviews])->with('message', 'Отзыв успешно добавлен');
    }
}
