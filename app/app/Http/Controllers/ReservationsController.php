<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Hospital;
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
        return view('reservations_create', compact('hospital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hospital_id' => 'required',
            'user_id' => 'required',
            'am_pm' => 'required',
            'date' => 'required',
            'comment' => 'nullable|max:200',
        ]);

        // 予約モデルを作成して保存
        $reservation = new Reservation();
        $reservation->hospital_id = $request->input('hospital_id');
        $reservation->user_id = $request->input('user_id');
        $reservation->am_pm = $request->input('am_pm');
        $reservation->date = $request->input('date');
        $reservation->comment = $request->input('comment');
        $reservation->save();

        $redirect = redirect()->route('hospitals.show', $request->input('hospital_id'))->with('success', '予約が完了しました！');

        return $redirect;
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
