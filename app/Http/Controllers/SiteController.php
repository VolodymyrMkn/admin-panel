<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Models\Block;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SiteController extends Controller
{
    public function page(Request $request, LanguageRequest $langRequest)
    {
        $languages = Language::all();
        $langSlug = $langRequest->language ?? Language::first()->slug;

        App::setLocale($langSlug);

        $langId = Language::where('slug', $langSlug)->first()->id;
        $slug = '/'.$request->slug;

        $page = Page::where('slug', $slug)->with(['blocks'=> function($query){
            $query->where('show', 1)->with('template:id,slug,type');
        }], 'blocks.blocks')->first();

        $meta = json_decode($page->meta)?->{ $langId } ?? null;

        $page->blocks = $page->blocks->map(function ($block) use ($langId) {
            if($block->template->type=='general'){
                $block = Block::with('blocks')
                    ->where('type', 'general')
                    ->where('template_id', $block->template_id)->first();
            }
            $block->option = json_decode($block->option)?->{$langId}  ?? null;
            $block->blocks->each(function ($subblock) use ($langId) {
                $subblock->option = json_decode($subblock->option)?->{$langId}  ?? null;
            });
            return $block;
        });

        $menus = Menu::where('type', 'header')->whereNull('menu_id')->where('show', 1)->with('template', 'menus.template')->get();
        $menus->each(function ($menu) use ($langId) {
            $menu->option = json_decode($menu->option)?->{$langId}  ?? null;
            $menu->menus->each(function ($subMenu) use ($langId) {
                $subMenu->option = json_decode($subMenu->option)?->{$langId}  ?? null;
            });
        });

        return view('site.index', compact(['menus', 'page', 'meta', 'languages', 'langSlug', 'slug']));
    }
}
