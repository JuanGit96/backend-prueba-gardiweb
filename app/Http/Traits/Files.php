<?php

namespace App\Http\Traits;

use App\File as FileModel;
use App\Folder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait Files
{
    /**
     * Guarda archivo traido por multipart en carpeta publica del sistema.
     * necesita el archivo multipart y el id de la carpeta a guardar
     */
    public function saveFile($file, $folder_extra = "")
    {
        try
        {
            //obtenemos el nombre del archivo
            $nombre = str_replace(":","",Carbon::now())."_".$file->getClientOriginalName();

            $path = 'files/'.$folder_extra."/";

            //indicamos que queremos guardar un nuevo archivo en el disco local
            Storage::disk('public')->put($path.$nombre,  File::get($file));

            return [
                "success" => true,
                "name_file" => $nombre
            ];
        }
        catch(\Exception $e)
        {
            return [
                "success" => false,
                "message" => $e
            ];
        }


    }


}
