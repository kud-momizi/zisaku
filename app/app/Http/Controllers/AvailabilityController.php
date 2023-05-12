<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Availability;

class AvailabilityController extends Controller
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
    public function create($hospital_id)
    {
        // ログイン中のユーザーに関連付けられた Hospital モデルを取得
        $hospital = Hospital::findOrFail($hospital_id);

        return view('availabilities_create', compact('hospital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $hospital_id)
    {
        $hospital = Hospital::findOrFail($hospital_id);

        $request->validate([
            'am_start_time' => 'nullable|date_format:H:i',
            'am_end_time' => 'nullable|date_format:H:i|after:am_start_time',
            'am_limit' => 'required|integer|min:0',
            'pm_start_time' => 'nullable|date_format:H:i',
            'pm_end_time' => 'nullable|date_format:H:i|after:pm_start_time',
            'pm_limit' => 'required|integer|min:0',
            'day_of_week' => 'required|integer|min:0|max:6',
            'note' => 'nullable|string|max:255',
        ]);

        $availability = new Availability([
            'hospital_id' => $hospital->id,
            'day_of_week' => $request->input('day_of_week'),
            'am_start_time' => $request->input('am_start_time'),
            'am_end_time' => $request->input('am_end_time'),
            'am_limit' => $request->input('am_limit'),
            'pm_start_time' => $request->input('pm_start_time'),
            'pm_end_time' => $request->input('pm_end_time'),
            'pm_limit' => $request->input('pm_limit'),
            'note' => $request->input('note')
        ]);

        // Availability モデルを保存
        $availability->save();

        return redirect()->route('hospitals.home')->with('success', __('予約可能時間を登録しました。'));
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
