<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Hospital;
use App\Models\Availability;
use Illuminate\Http\Request;

class ReservationsController extends Controller
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
    public function create(Hospital $hospital)
    {
        $availabilities = Availability::where('hospital_id', $hospital->id)->get()->keyBy('day_of_week')->toArray();
        $unavailableDays = [];

        foreach ($availabilities as $dayOfWeek => $availability) {
            if (!$availability || $availability['day_limit'] === null) {
                $unavailableDays[] = $dayOfWeek;
            }
        }

        return view('reservations_create', compact('hospital', 'unavailableDays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required',
            'user_id' => 'required',
            'date' => 'required|date',
            'comment' => 'nullable|string|max:200',
        ]);

        $hospitalId = $request->input('hospital_id');
        $userId = $request->input('user_id');
        $date = $request->input('date');
        $dayOfWeek = date('w', strtotime($date)); // 選択した日付の曜日を取得

        // 予約可能日を取得
        $availability = Availability::where('hospital_id', $hospitalId)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        // 受入人数が設定されていない場合はエラーメッセージを表示
        if (!$availability || $availability->day_limit === null) {
            return redirect()->back()->withErrors('予約できない日付です。');
        }

        // 予約済み人数を取得
        $reservedCount = Reservation::where('hospital_id', $hospitalId)
            ->where('date', $date)
            ->count();

        // 受け入れ可能人数を超える場合はエラーメッセージを表示
        if ($reservedCount >= $availability->day_limit) {
            return redirect()->back()->withErrors('予約可能人数に達しています。');
        }

        // 予約の作成
        $reservation = new Reservation();
        $reservation->hospital_id = $hospitalId;
        $reservation->user_id = $userId;
        $reservation->date = $date;
        $reservation->comment = $request->input('comment');
        $reservation->save();

        return view('users_home');
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
