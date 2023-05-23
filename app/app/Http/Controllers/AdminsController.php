<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Availability;
use App\Models\Reservation;
use App\Models\Tag;

class AdminsController extends Controller
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
        $availabilities = Availability::where('hospital_id', $hospital->id)->get()->keyBy('day_of_week')->toArray();
        $tags = Tag::all(); // タグの一覧を取得
        return view('admins_show', compact('hospital', 'availabilities', 'tags'));
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
        return view('admins_home');
    }

    public function search(Request $request)
    {
        $searchHospital = $request->input('search_hospital');
        $searchPrefecture = $request->input('search_prefecture');
        $searchCity = $request->input('search_city');
        $searchAddress = $request->input('search_address');
        $searchTag = $request->input('search_tag');

        $query = Hospital::query();
        $tags = Tag::all();

        if ($searchHospital) {
            $query->where('name', 'like', '%' . $searchHospital . '%');
        }

        if ($searchPrefecture || $searchCity || $searchAddress) {
            $query->whereHas('address', function ($query) use ($searchPrefecture, $searchCity, $searchAddress) {
                if ($searchPrefecture) {
                    $query->where('ken_name', 'like', '%' . $searchPrefecture . '%');
                }
        
                if ($searchCity) {
                    $query->where('city_name', 'like', '%' . $searchCity . '%');
                }
        
                if ($searchAddress) {
                    $query->where(function ($query) use ($searchAddress) {
                        $query->where('town_name', 'like', '%' . $searchAddress . '%')
                            ->orWhere('block_name', 'like', '%' . $searchAddress . '%');
                    });
                }
            });
        }

        if ($searchTag) {
            $query->whereHas('tags', function ($query) use ($searchTag) {
                $query->where('tags.id', $searchTag);
            });
        }

        $hospitals = $query->paginate(5);

        return view('admins_home', compact('hospitals'));
    }
}
