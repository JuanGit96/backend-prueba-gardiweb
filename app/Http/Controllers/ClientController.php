<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Traits\Files;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use Files;

    private $folder;

    public function __construct()
    {
        $this->folder = "clients/";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return $this->showAll($clients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $client = Client::create($data);

        $fileToUpload = $request->file("image_profile"); #archivo a subir

        $path = $this->folder.$client->id;

        $saveFile = $this->saveFile($fileToUpload, $path); #guardando archivo

        $client->image_profile = $saveFile["name_file"];

        $client->save();

        if(!$saveFile["success"])
            return $this->errorResponse("error al subir imagen de perfil", 500);

        return $this->showOne($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $this->showOne($client);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->all();

        $client->update($data);

        if(isset($data["image_profile"]))
        {
            $fileToUpload = $request->file("image_profile"); #archivo a subir
    
            $path = $this->folder.$client->id;
    
            $saveFile = $this->saveFile($fileToUpload, $path); #guardando archivo
    
            $client->image_profile = $saveFile["name_file"];
    
            $client->save();
    
            if(!$saveFile["success"])
                return $this->errorResponse("error al subir imagen de perfil", 500);

        }

        return $this->showOne($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return $this->showOne($client);
    }
}
