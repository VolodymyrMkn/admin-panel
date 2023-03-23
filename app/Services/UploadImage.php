<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;

class UploadImage
{
    public static function upload($files, $mainFolder, $updateBlocksArray)
    {
        foreach($files as $blockId => $option) {
            foreach($option as $langId => $imageArray) {
                foreach($imageArray as $fieldName => $image) {
                    $folder = "$mainFolder/$blockId/$langId/$fieldName";
                    $filename = $image->getClientOriginalName();
                    Storage::disk('public')->putFileAs($folder, $image, $filename);
                    $updateBlocksArray[$blockId]['option'][$langId][$fieldName] = asset("storage/$folder/$filename");
                }
            }
        }
        return $updateBlocksArray;
    }

}
