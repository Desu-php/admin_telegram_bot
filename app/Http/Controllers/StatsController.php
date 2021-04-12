<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('stats.index');

    }

    public function indexAjax(Request  $request)
    {
        //
        $datas = TelegramUser::query();
        return DataTables::eloquent($datas)
            ->editColumn('avatar', function ($data){
                if (!empty($data)){
                    return '<img src="'.$data->avatar.'" style="height:50px;width:50px" alt="'.$data->username.'" />';
                }
                return  '';
            })
            ->editColumn('created_at', function ($data){
                return $data->created_at->format('d.m.Y h:i:s');
            })
            ->rawColumns(['avatar'])
            ->escapeColumns(null)
            ->make(true);
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
