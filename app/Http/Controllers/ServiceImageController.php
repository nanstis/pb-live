<?php


namespace App\Http\Controllers;

use App\Interfaces\IImageService;
use App\Models\PartnersInfo;
use App\Models\ServiceImage;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceImageController extends Controller
{
    private $imageService;

    public function __construct(IImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function uploadMainImage($id_partner, $cat, Request $request)
    {
        if (Auth::user()->type != 'admin') {
            $id_partner = Auth::user()->id_partner;
        }

        $partner = PartnersInfo::where('id_partner', $id_partner)->first();
        if (!$partner) {
            return response()->json(['message' => 'partner not found'], 400);
        }


        if ($request->has('main_image')) {
            $file = $request->file('main_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            Storage::putFileAs('images/', $file, $filename);


            ServiceImage::where('partners_info_id', $partner->id)->where('is_main', 1)->delete();

            $image = new ServiceImage;
            $image->partners_info_id = $partner->id;
            $image->id_partner = $partner->id_partner;
            $image->category = $cat;
            $image->image_name = $filename;
            $image->is_main = 1;
            $image->save();

            PartnersInfo::where('id', $partner->id)->update(['main_img' => $filename]);
            $this->imageService->createThumbnail('images/' . $filename, 'images/thumbnails/' . $filename);


            if ($partner->main_img) {
                Storage::delete('images/' . $partner->main_img);
                Storage::delete('images/thumbnails/' . $partner->main_img);
            }
        }

        return redirect()->back()->with('success', 'Image uploaded successfully');
    }

    public function upload($id_partner, $cat, Request $request)
    {
        if (Auth::user()->type != 'admin') {
            $id_partner = Auth::user()->id_partner;
        }

        $partner = PartnersInfo::where('id_partner', $id_partner)->with(['currentPlan'])->first();
        if (!$partner) {
            return response()->json(['message' => 'partner not found'], 400);
        }

        $uploaded = ServiceImage::where('partners_info_id', $partner->id)->whereNull('is_main')->count();

        $count = $partner->currentPlan->photos_num ?? 1;

        if ($uploaded >= $count) {
            return response()->json(['message' => 'Limit'], 400);
        }

        if ($request->has('files_image')) {
            $file = $request->file('files_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            DB::beginTransaction();
            try {
                if ($file->storeAs('images', $filename)) {
                    $img = new ServiceImage();
                    $img->partners_info_id = $partner->id;
                    $img->id_partner = $partner->id_partner;
                    $img->category = 'cat';
                    $img->image_name = $filename;
                    $img->is_main = null;
                    $img->save();
                }

                $this->imageService->createThumbnail('images/' . $filename, 'images/thumbnails/' . $filename);

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Storage::delete('images/' . $filename);
                Storage::delete('images/thumbnails/' . $filename);
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
        return response()->json(['message' => 'ok'], 200);
    }

    public function remove(Request $request)
    {
        if (Auth::user()->type != 'admin') {
            $id_partner = Auth::user()->id_partner;
        } else {
            $id_partner = $request->get('id_partner');
        }

        $img = ServiceImage::where('id_partner', $id_partner)->where('id', $request->get('imgId'))->first();
        if (!$img) {
            return response()->json(['message' => 'not found'], 400);
        }

        ServiceImage::where('id', $img->id)->delete();
        Storage::delete('images/' . $img->image_name);
        Storage::delete('images/thumbnails/' . $img->image_name);


        return response()->json(['message' => 'ok'], 200);
    }
}
