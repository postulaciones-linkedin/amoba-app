<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\DisabledDays;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendar = Calendar::all();
        return $calendar;
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
        if ($request->name == NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'Campo name requerido'
            ], 400);
        }
        if ($request->day === NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'Campo day requerido'
            ], 400);
        }
        $calendar = new Calendar();
        $calendar->name = $request->name;

        $calendar->updated_at = NULL;
        $calendar->created_at = date('Y-m-d H:i:s');

        $calendar->save();

        $returnData = [
            "name" => $calendar->name,
            "calendar_id" => $calendar->id,
            "created_at" => $calendar->created_at,
            "id" => $calendar->id
        ];

        $disabledDays = new DisabledDays();
        $disabledDays->calendar_id = $calendar->id;
        $disabledDays->day = $request->day;
        $disabledDays->enabled = 1;
        $disabledDays->created_at = date('Y-m-d');

        $disabledDays->save();

        return $returnData;
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
        if ($request->name === NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'Campo nombre es requerido'
            ], 400);
        }
        if ($id === NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'El campo id es requerido'
            ], 400);
        }
        $calendar = Calendar::findOrFail($request->id);
        $calendar->name = $request->name;
        $calendar->calendar_id = $request->calendar_id;
        $calendar->updated_at = date('Y-m-d H:i:s');

        $calendar->save();

        $returnData = [
            "name" => $calendar->name,
            "calendar_id" => $calendar->calendar_id,
            "created_at" => $calendar->created_at,
            "id" => $calendar->id
        ];
        return $returnData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendarFetch = Calendar::find($id);
        if ($calendarFetch === NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'El campo id es requerido'
            ], 400);
        }
        $calendar = Calendar::destroy($id);
        return $calendar;
    }

    /**
     * Show disabled days table
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notAvailableDays()
    {
        $disabledDays = DisabledDays::all();
        return $disabledDays;
    }
}
