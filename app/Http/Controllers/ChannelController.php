<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Traits\DownloadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class ChannelController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('channels.create');
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
            'url' => 'required|url'
        ]);

        if($validator->fails()){
            return Response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()
            ],400);
        }

        $browser = new HttpBrowser(HttpClient::create());
        $crawler =  $browser->request('GET', $request->url);

        if ($crawler->filter('.tgme_page_post')->count() == 0){
            return Response()->json([
                'success' => false,
                'message' => 'Канал не найден'
            ], 404);
        }

        $image = '';

        if ($crawler->filter('.tgme_page_photo_image')->count()){
            $image = $crawler->filter('.tgme_page_photo_image')->attr('src');
        }


        $name = $crawler->filter('.tgme_page_title')->text();

        $originName = explode('/t.me/', $request->url);

        if (!empty($image)){
            $avatar = $this->downloadImage($image);
        }else{
            $avatar = null;
        }

        Channel::create([
            'name' => $name,
            'url' => $request->url,
            'avatar' => $avatar,
            'origin_name' => $originName[1],
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
