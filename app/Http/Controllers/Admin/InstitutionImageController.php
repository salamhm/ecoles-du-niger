<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadAble;
use App\Contracts\InstitutionContract;
use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\InstitutionImage;
use Illuminate\Http\Request;

class InstitutionImageController extends Controller
{
    use UploadAble;

    protected $institutionRepository;

    public function __construct(institutionContract $institutionRepository)
    {
        $this->institutionRepository = $institutionRepository;
    }

    public function upload(Request $request)
    {
        $institution = $this->institutionRepository->findInstitutionById($request->institution_id);
    
        if ($request->has('image')) {
    
            $image = $this->uploadOne($request->image, 'institutions');
    
            $institutionImage = new InstitutionImage([
                'full'      =>  $image,
            ]);
    
            $institution->images()->save($institutionImage);
        }
    
        return response()->json(['status' => 'Success']);
    }

    public function delete($id)
    {
        $image = InstitutionImage::findOrFail($id);
    
        if ($image->full != '') {
            $this->deleteOne($image->full);
        }
        $image->delete();
    
        return redirect()->back();
    }
}
