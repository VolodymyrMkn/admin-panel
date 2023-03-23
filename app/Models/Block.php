<?php

namespace App\Models;

use App\Services\UploadImage;
use App\Traits\OrderBySortTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Block extends Model
{
    use HasFactory, OrderBySortTrait;

    protected $fillable = ['name', 'type', 'page_id', 'template_id', 'option', 'block_id', 'show', 'sort'];

    public static function decodeOptions($blocks)
    {
        return $blocks->each(function ($block){
            $block->option = json_decode($block->option);
            $block->blocks->each(function ($subBlock){
                $subBlock->option = json_decode($subBlock->option);
            });
        });
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public static function updateBlocks($blocks, $files, $names = [])
    {
        $updateBlocksArray = [];
        foreach($blocks ?? [] as $id => $option) {
            $updateBlocksArray[$id] = ['id' => $id, 'option'=> $option, 'name' => $names[$id] ?? ''];
        }
        if($files) {
            $updateBlocksArray = UploadImage::upload($files, 'blocks', $updateBlocksArray);

        }
        foreach ($updateBlocksArray as $key => $block) {
            $updateBlocksArray[$key]['option'] = json_encode($block['option']);
        }

        \Batch::update(new Block, $updateBlocksArray, 'id');
    }
}
