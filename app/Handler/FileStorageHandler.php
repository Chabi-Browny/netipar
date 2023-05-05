<?php

namespace App\Handler;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
/**
 * Description of StorageHandler
 *
 * @author csbb
 */
class FileStorageHandler
{
    /**
     * @var UploadedFile
     */
    protected $uploadedFile;

    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**/
    public function isFileExist(string $fileToCheck)
    {
        return Storage::disk('local')->exists($fileToCheck);
    }

    /**/
    public function changeFile(string $fileToCheck)
    {
        if ($this->isFileExist($fileToCheck))
        {
            $this->singleFileDelete($fileToCheck);
        }
        // retun the new file name+dir
        return $this->addFile();
    }

    /**/
    public function addFile()
    {
//        dump($this->uploadedFile->getFileInfo());

//        dump($this->uploadedFile->getFilename()); //// OK
//        dump($this->uploadedFile->getClientOriginalName()); //// OK
//        dump($this->uploadedFile->getClientOriginalExtension());//// OK
//        dump($this->uploadedFile->getRealPath()); //// OK

//        $currentPath = $this->uploadedFile->getRealPath();
//        $currentFileName = $this->uploadedFile->getFilename();
        //////////////////////////////////////////

        $originalExtension = $this->uploadedFile->getClientOriginalExtension();

        $fileName = 'umi_' . time() . '.' . $originalExtension;

        return Storage::putFileAs( 'userImages', $this->uploadedFile, $fileName);
    }

    /**/
    public function singleFileDelete(string $fileToDelete)
    {
        return Storage::delete($fileToDelete);
    }

}
