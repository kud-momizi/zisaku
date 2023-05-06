<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = Hospital::all();
        $params = Hospital::where('user_id', Auth::id())->get();
            if ($params->isEmpty()) {
                return redirect()->route('hospitals.create');
            }
        return view('hospitals_home', compact('hospitals'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('hospitals_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         // バリデーションルールを定義
        $rules = [
            'name' => 'required|max:30',
            'title' => 'required|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intro' => 'required|max:300',
            'tel' => 'required|numeric|digits_between:10,11',
            'web_url' => 'nullable|url|max:200',
            'post_code' => 'required|string|max:8',
            'ken_name' => 'required|string|max:8',
            'city_name' => 'required|string|max:24',
            'town_name' => 'required|string|max:32',
            'block_name' => 'required|string|max:64',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules);

        // 画像ファイルのアップロード
        $imagePath = $request->file('image')->store('public');

        // フォームから送信されたデータを登録
        $hospital = new Hospital();
        $hospital->name = $validatedData['name'];
        $hospital->title = $validatedData['title'];
        $hospital->image = basename($imagePath);
        $hospital->intro = $validatedData['intro'];
        $hospital->tel = $validatedData['tel'];
        $hospital->web_url = $validatedData['web_url'];

        $address = new Address();
        $address->post_code = $validatedData['post_code'];
        $address->ken_name = $validatedData['ken_name'];
        $address->city_name = $validatedData['city_name'];
        $address->town_name = $validatedData['town_name'];
        $address->block_name = $validatedData['block_name'];
        $address->save();

        // ログインしているユーザーのIDをセット
        $hospital->user_id = $this->user->id;

        // 作成した住所情報をHospitalsモデルに紐づけて保存
        $hospital->address_id = $address->id;

        // 作成したHospitalモデルを保存

        $hospital->save();

        // 保存が完了したら、リダイレクトする
        return redirect('/hospitals_home')->with('success', '医療機関を登録しました！');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
