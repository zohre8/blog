<?php

namespace App\Http\Controllers\admin;

use App\DTOs\PostDTO;
use App\DTOs\SitePageDTO;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Services\SitePageService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private SitePageService $SitePageService;

    public function __construct(SitePageService $sitePageService)
    {
        $this->SitePageService=$sitePageService;
    }
    public function about()
    {
        $about=SitePage::where('slug', 'about')->first();
        return view('admin.setting.about',compact('about'));
     }

    public function updateAbout(Request $request,$id)
    {
        try{
            $dto=SitePageDTO::fromRequest($request);
            $about = $this->SitePageService->SiteUpdate($id, $dto);

            return redirect()->route('setting.about')->with('success', 'درباره ما با موفقیت ویرایش شد.');
        }catch (\Exception $e){
            return back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function contact()
    {
        $contact=SitePage::where('slug', 'contact')->first();
        return view('admin.setting.contact',compact('contact'));
    }

    public function updateContact(Request $request,$id)
    {
        try{
            $dto=SitePageDTO::fromRequest($request);
            $contact = $this->SitePageService->SiteUpdate($id, $dto);

            return redirect()->route('setting.contact')->with('success', 'درباره ما با موفقیت ویرایش شد.');
        }catch (\Exception $e){
            return back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function rules()
    {
        $rules=SitePage::where('slug', 'rules')->first();
        return view('admin.setting.rules',compact('rules'));
    }

    public function updateRules(Request $request,$id)
    {
        try{
            $dto=SitePageDTO::fromRequest($request);
            $rules = $this->SitePageService->SiteUpdate($id, $dto);

            return redirect()->route('setting.rules')->with('success', 'درباره ما با موفقیت ویرایش شد.');
        }catch (\Exception $e){
            return back()->withErrors(['error'=> $e->getMessage()]);
        }
    }
}
