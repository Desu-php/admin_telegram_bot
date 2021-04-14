<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\MainChannel;
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
    public function index(Request $request)
    {
        //
        $mainChannel = MainChannel::find($request->channel);

        if (empty($mainChannel)) {
            abort(404);
        }

        return view('stats.index', compact('mainChannel'));

    }

    public function indexAjax(Request $request)
    {
        //
        $datas = TelegramUser::where('main_channel_id', $request->channel);
        return DataTables::eloquent($datas)
            ->editColumn('avatar', function ($data) {
                if ($data->avatar != "None" || empty($data->avatar)){
                    return '<img class="rounded-circle" src="'.Config()->get('app.bot_domen').'/'.$data->avatar.'" style="width:50px; height:50px">';
                }else{
                    if ($data->first_name != 'None'){
                        $name = $data->first_name;
                    }elseif ($data->last_name != 'None'){
                        $name = $data->last_name;
                    }else {
                        $name = $data->username;
                    }
                    $colors =  ['primary', 'danger', 'secondary', 'warning', 'success', 'dark'];
                    return  '
                    <div class="d-flex justify-content-center align-items-center m-0">
                  <div style="width: 50px; height: 50px" class="text-uppercase d-flex justify-content-center align-items-center rounded-circle h3 text-white-50 bg-'.$colors[rand(0, count($colors) - 1)].'">
                  '.mb_substr($name, 0,1).'
</div>
                    </div>';

                }
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d.m.Y H:i:s');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
