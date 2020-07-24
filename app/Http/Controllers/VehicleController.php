<?php

namespace App\Http\Controllers;

use App\Http\Traits\Files;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    use Files;

    private $folder;

    public function __construct()
    {
        $this->folder = "vehicles/";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return $this->showAll($vehicles);
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

        $data["plate"] = ucfirst(strtolower($data["plate"]));

        $vehicle = Vehicle::create($data);

        $fileToUpload = $request->file("image"); #archivo a subir

        $path = $this->folder.$vehicle->id;

        $saveFile = $this->saveFile($fileToUpload, $path); #guardando archivo

        $vehicle->image = $saveFile["name_file"];

        $vehicle->save();

        if(!$saveFile["success"])
            return $this->errorResponse("error al subir imagen de perfil", 500);

        return $this->showOne($vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return $this->showOne($vehicle);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->all();

        $vehicle->update($data);

        if(isset($data["image"]))
        {
            $fileToUpload = $request->file("image"); #archivo a subir
    
            $path = $this->folder.$vehicle->id;
    
            $saveFile = $this->saveFile($fileToUpload, $path); #guardando archivo
    
            $vehicle->image = $saveFile["name_file"];
    
            $vehicle->save();
    
            if(!$saveFile["success"])
                return $this->errorResponse("error al subir imagen de perfil", 500);
        }            

        return $this->showOne($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return $this->showOne($vehicle);
    }
}
