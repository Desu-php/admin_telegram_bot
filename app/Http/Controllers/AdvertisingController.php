<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\Channel;
use App\Models\MainChannel;
use App\Models\TelegramUser;
use App\Models\User;
use Carbon\Carbon;
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

        $datas = Advertising::query();
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
        $mainChannels = MainChannel::all();
        return view('advertisings.create', compact('mainChannels'));
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
            'channel_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'main_channel' => 'required|exists:main_channels,id',
            'name' => 'required|string|max:255',
            'changed' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        $advertising = Advertising::create([
            'channel_name' => $request->channel_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'main_channel_id' => $request->main_channel,
            'name' => $request->name,
        ]);

        if ($request->has('changed')) {
            TelegramUser::whereDate('created_at', '<=', $request->end_date)
                ->whereDate('created_at', '>=', $request->start_date)
                ->where('main_channel_id', $advertising->main_channel_id)
                ->update([
                    'advertisings' => $request->name
                ]);
        }

        return Response()->json([
            'success' => true,
            'message' => 'Реклама добавлена'
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
        $mainChannels = MainChannel::all();
        $data = Advertising::find($id);

        if (empty($data)) {
            abort(404);
        }

        return view('advertisings.edit', compact('data', 'mainChannels'));
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
            'channel_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'main_channel' => 'required|exists:main_channels,id',
            'name' => 'required|string|max:255',
            'changed' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        $advertising = Advertising::where('id', $id)->update([
            'channel_name' => $request->channel_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'main_channel_id' => $request->main_channel,
            'name' => $request->name,
        ]);

        if ($request->has('changed')) {
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');

            TelegramUser::whereDate('created_at', '<=', $end_date)
                ->whereDate('created_at', '>=', $start_date)
                ->where('main_channel_id', $request->main_channel)
                ->update([
                    'advertisings' => $request->name,
                ]);
        }

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
