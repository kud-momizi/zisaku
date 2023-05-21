<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Availability;
use App\Models\Reservation;
use App\Models\Tag;
use App\Models\User;
use App\Models\HospitalTag;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();

        // 検索ロジック
        $search = $request->input('search');
        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')->get();
        }
        $tags = Tag::all();

        return view('admins_index', compact('users', 'search','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital = Hospital::findOrFail($id);
        $availabilities = $hospital->availabilities;
        $availabilities = Availability::where('hospital_id', $hospital->id)->get()->keyBy('day_of_week')->toArray();
        $tags = Tag::all(); // タグの一覧を取得
        return view('hospitals_detail', compact('hospital', 'availabilities', 'tags'));

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
        $user = User::findOrFail($id);
        $user->delete();
    
        return view('admins_index')->with('success', 'ユーザーを削除しました');
    }

    public function home()
    {
        $reservedHospitals = Reservation::with('hospital')->where('user_id', Auth::id())->get()->pluck('hospital');

        return view('users_home', compact('reservedHospitals'));
    }

    /**
     * Perform the hospital search based on the given criteria.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchHospital = $request->input('search_hospital');
        $searchAddress = $request->input('search_address');
        $searchTag = $request->input('search_tag');

        $query = Hospital::query();
        $tags = Tag::all();

        if ($searchHospital) {
            $query->where('name', 'like', '%' . $searchHospital . '%');
        }

        if ($searchAddress) {
            $query->whereHas('address', function ($query) use ($searchAddress) {
                $query->where('ken_name', 'like', '%' . $searchAddress . '%')
                    ->orWhere('city_name', 'like', '%' . $searchAddress . '%')
                    ->orWhere('town_name', 'like', '%' . $searchAddress . '%')
                    ->orWhere('block_name', 'like', '%' . $searchAddress . '%');
            });
        }

        if ($searchTag) {
            $query->whereHas('tags', function ($query) use ($searchTag) {
                $query->where('tags.id', $searchTag);
            });
        }

        $hospitals = $query->paginate(5);

        return view('users_home', compact('hospitals', 'tags'));
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
    
        // ユーザーが予約をキャンセルする処理
        
        $reservation->delete(); // 予約データを削除
        
        return redirect()->back()->with('success', '予約をキャンセルしました');
    }

}
