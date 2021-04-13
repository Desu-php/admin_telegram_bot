<?php

namespace App\Http\Controllers;

use App\Models\MainChannel;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MainChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('main_channels.index');
    }

    public function indexAjax(Request $request)
    {
        //
        $datas = MainChannel::query();
        return DataTables::eloquent($datas)
            ->addColumn('action', function ($data) {
                $btns = '<a href="javascript:void(0)"  onclick="Delete(' . $data->id . ')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Удалить</a>';
                $btns .= ' <a href="' . url('main_channels/' . $data->id . '/edit') . '"  class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Изменить</a>';
                return $btns;
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
        return view('main_channels.create');
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
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()){
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        MainChannel::create($request->all());

        return Response()->json([
            'success' => true,
            'message' => 'Канал добавлен'
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
       $data = MainChannel::find($id);
       return view('main_channels.edit', compact('data'));
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
            'name' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()){
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        MainChannel::where('id', $id)
        ->update([
            'name' => $request->name,
            'url' => $request->url
        ]);

        return Response()->json([
            'success' => true,
            'message' => 'Канал обновлен'
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
        $data = MainChannel::destroy($id);
        return Response()->json($data);
    }
}
