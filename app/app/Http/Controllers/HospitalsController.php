<?php
//医療機関ホーム表示兼、情報変更用のコントローラー
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Address;
use App\Models\Availability;

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
        $hospitals = Hospital::where('user_id', Auth::id())->get();
        if ($hospitals->isEmpty()) {
            return redirect()->route('hospitals.create');
        }
        $hospital = Hospital::where('user_id', Auth::id())->first();
        $availabilities = Availability::where('hospital_id', $hospital->id)->get()->keyBy('day_of_week')->toArray();

        return view('hospitals_home', compact('hospitals', 'availabilities'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intro' => 'required|max:300',
            'tel' => 'required|numeric|digits_between:10,11',
            'web_url' => 'nullable|url|max:200',
            'post_code' => 'required|string|max:8',
            'ken_name' => 'required|string|max:8',
            'city_name' => 'required|string|max:24',
            'town_name' => 'required|string|max:32',
            'block_name' => 'nullable|string|max:64',
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

        // ログインしているユーザーのIDをセット
        $address->user_id = $this->user->id;

        // Addressモデルを保存
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
        $hospital = Hospital::with('address')->findOrFail($id);
        return view('hospitals_edit', compact('hospital'));
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
        // バリデーションルールを定義
        $rules = [
            'name' => 'required|max:30',
            'title' => 'required|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intro' => 'required|max:300',
            'tel' => 'required|numeric|digits_between:10,11',
            'web_url' => 'nullable|url|max:200',
            'post_code' => 'required|string|max:8',
            'ken_name' => 'required|string|max:8',
            'city_name' => 'required|string|max:24',
            'town_name' => 'required|string|max:32',
            'block_name' => 'nullable|string|max:64',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules);

        // 対象のHospitalモデルを取得
        $hospital = Hospital::findOrFail($id);

         // フォームデータの設定
        $hospital->name = $validatedData['name'];
        $hospital->title = $validatedData['title'];
        $hospital->intro = $validatedData['intro'];
        $hospital->tel = $validatedData['tel'];
        $hospital->web_url = $validatedData['web_url'];

        $address = $hospital->address;
        $address->post_code = $validatedData['post_code'];
        $address->ken_name = $validatedData['ken_name'];
        $address->city_name = $validatedData['city_name'];
        $address->town_name = $validatedData['town_name'];
        $address->block_name = $validatedData['block_name'];
        $address->save();

            // 画像がアップロードされている場合の処理
        if ($request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('public');
            $hospital->image = basename($imagePath);
        } else {
            // 画像がアップロードされていない場合は、元の画像パスを保持する
            $hospital->image = $hospital->image;
        }

        // Hospitalモデルを保存
        $hospital->save();

        // 保存が完了したら、リダイレクトする
        return redirect('/hospitals_home')->with('success', '医療機関情報を更新しました！');
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
