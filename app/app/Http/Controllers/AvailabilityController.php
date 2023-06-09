<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
            'day_limit' => 'nullable|integer|min:0',
            'pm_start_time' => 'nullable|date_format:H:i',
            'pm_end_time' => 'nullable|date_format:H:i|after:pm_start_time',
            'day_of_week' => 'nullable|integer|min:0|max:6',
        ]);

        $availability = new Availability([
            'hospital_id' => $hospital->id,
            'day_of_week' => $request->input('day_of_week'),
            'am_start_time' => $request->input('am_start_time'),
            'am_end_time' => $request->input('am_end_time'),
            'day_limit' => $request->input('day_limit'),
            'pm_start_time' => $request->input('pm_start_time'),
            'pm_end_time' => $request->input('pm_end_time'),
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
    public function edit($availability_id)
    {
        $availability = Availability::findOrFail($availability_id);
        $hospital = $availability->hospital;

        return view('availabilities_edit', compact('hospital', 'availability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $availability_id)
    {
        //  dd($request->all());
        $availability = Availability::where('id', $availability_id)->firstOrFail();
        // dd($availability);
    
        $request->validate([
            'am_start_time' => 'nullable',
            'am_end_time' => 'nullable|after:am_start_time',
            'day_limit' => 'nullable|integer|min:0',
            'pm_start_time' => 'nullable',
            'pm_end_time' => 'nullable|after:pm_start_time',
            'day_of_week' => 'nullable|integer|min:0|max:6',
        ]);

        // $availability->am_start_time = $request->input('am_start_time');
        // $availability->am_end_time = $request->input('am_end_time');
        // $availability->day_limit = $request->input('day_limit');
        // $availability->pm_start_time = $request->input('pm_start_time');
        // $availability->pm_end_time = $request->input('pm_end_time');
        // $availability->day_of_week = $request->input('day_of_week');

        $availability->am_start_time = $request->am_start_time;
        $availability->am_end_time = $request->am_end_time;
        $availability->day_limit = $request->day_limit;
        $availability->pm_start_time = $request->pm_start_time;
        $availability->pm_end_time = $request->pm_end_time;
        $availability->day_of_week = $request->day_of_week;

        $availability->save();
        
        return redirect()->route('hospitals.home')->with('success', __('予約可能時間を修正しました。'));
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
