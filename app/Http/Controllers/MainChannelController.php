<?php

namespace App\Http\Controllers;

use App\Models\MainChannel;
use App\Models\TelegramUser;
use App\Traits\DownloadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Yajra\DataTables\Facades\DataTables;

class MainChannelController extends Controller
{
    use DownloadImage;
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
            ->editColumn('avatar', function ($data){
                if (!is_null($data->avatar)){
                    return '<img class="rounded-circle" src="'.asset($data->avatar).'" style="width:50px; height:50px">';
                }else{
                    $colors =  ['primary', 'danger', 'secondary', 'warning', 'success', 'dark'];
                    return  '
                    <div class="d-flex justify-content-center align-items-center m-0">
                  <div style="width: 50px; height: 50px" class="text-uppercase d-flex justify-content-center align-items-center rounded-circle h3 text-white-50 bg-'.$colors[rand(0, count($colors) - 1)].'">
                  '.mb_substr($data->name, 0,1).'
</div>
                    </div>';

                }
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
            'url' => 'required|url',
        ]);

        if ($validator->fails()){
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ], 400);
        }

        $browser = new HttpBrowser(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
        $crawler =  $browser->request('GET', $request->url);

        if ($crawler->filter('.tgme_page_title')->count() == 0){
            return Response()->json([
                'success'=> false,
                'message' => 'Канал не найден'
            ], 404);
        }

        if (strpos($request->url,'joinchat')){
            $status = 'private';
            $name = $crawler->filter('.tgme_page_title')->text();
            $url = null;
        }else{
            $url = $request->url;
            $status = 'public';
            $name = $crawler->filter('.tgme_page_title')->text();
        }

        $image = $crawler->filter('.tgme_page_photo_image');

        if ($image->count() > 0){
            $avatar = $this->downloadImage($image->attr('src'));
        }else{
            $avatar = null;
        }

        MainChannel::create([
            'url' => $url,
            'name' => $name,
            'avatar' => $avatar,
            'user_url' => $request->url,
            'status' => $status
        ]);

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
