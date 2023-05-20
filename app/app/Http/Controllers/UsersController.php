<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Availability;
use App\Models\Reservation;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('hospitals_detail', compact('hospital', 'availabilities'));
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
        $keyword = $request->input('keyword');
        $address = $request->input('address');
        $workingHours = $request->input('search_hours');

        // Build the search query
        $query = Hospital::query();

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($address) {
            $query->whereHas('address', function ($query) use ($address) {
                $query->where('address', 'like', '%' . $address . '%');
            });
        }

        if ($workingHours) {
            $query->where('working_hours', 'like', '%' . $workingHours . '%');
        }

        $hospitals = $query->paginate(5);

        return view('users_home', compact('hospitals'));
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
    
        // ユーザーが予約をキャンセルする処理
        
        $reservation->delete(); // 予約データを削除
        
        return redirect()->back()->with('success', '予約をキャンセルしました');
    }

}
