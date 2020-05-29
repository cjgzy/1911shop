<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    public function index(){
        $slice=Cache::get('slice');
        dump($slice);
        if (!$slice) {
            echo "dd";
            // 首页幻灯片
        $slice = Goods::getSliceData();
        Cache::put('slice',$slice,60*60);
        }
    	// 获取顶级分类
    	$p_id = Cate::getPidData();
    	// dd($p_id);

    	// 首页精品展示
        $best = Goods::select('goods_id','goods_img','goods_name','goods_price')->where('is_best',1)->take(8)->get();

    	return view("index.index",['slice'=>$slice,'p_id'=>$p_id,'best'=>$best]);
    }
}
