<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('advertisings.index');
    }


    public function indexAjax(Request $request)
    {

        $datas = Advertising::with('channel');
        return DataTables::eloquent($datas)
            ->addColumn('action', function ($data) {
                $btns = '<a href="javascript:void(0)"  onclick="Delete(' . $data->id . ')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Удалить</a>';
                $btns .= ' <a href="' . url('advertisings/' . $data->id . '/edit') . '"  class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Изменить</a>';
                return $btns;
            })
            ->addColumn('range_time', function ($data) {
                return $data->start_date . ' - ' . $data->end_date;
            })
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
        $channels = Channel::all();
        return view('advertisings.create', compact('channels'));
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
        $validator = Validator::make($request->all(), [
            'channel' => 'required|exists:channels,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        if ($validator->fails()){
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        Advertising::create([
            'channel_id' => $request->channel,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return Response()->json([
            'success' => true,
            'message' => 'Реклама добавлен'
        ]);
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
        $channels = Channel::all();
        $data = Advertising::find($id);

        if (empty($data)){
            abort(404);
        }

        return view('advertisings.edit', compact('data', 'channels'));
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

        $validator = Validator::make($request->all(), [
            'channel' => 'required|exists:channels,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        if ($validator->fails()){
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        Advertising::where('id', $id)->update([
            'channel_id' => $request->channel,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return Response()->json([
            'success' => true,
            'message' => 'Реклама обновлена'
        ]);
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
        $data = Advertising::destroy($id);
        return Response()->json($data);
    }
}
