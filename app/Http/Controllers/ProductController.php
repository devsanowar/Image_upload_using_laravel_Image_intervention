<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(){
        return view('products');
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')) {

            $image = Image::make($request->file('image'));



            /**

             * Main Image Upload on Folder Code

             */

            $imageName = time().'-'.$request->file('image')->getClientOriginalName();

            $destinationPath = public_path('images/');

            $image->save($destinationPath.$imageName);


            /**

             * Generate Thumbnail Image Upload on Folder Code

             */

            $destinationPathThumbnail = public_path('images/thumbnail/');

            $image->resize(300,300);

            $image->save($destinationPathThumbnail.$imageName);


        }
        Product::create([
            'image'=> $imageName
        ]);
        return back()
        ->with('success','Image Upload successful')
        ->with('imageName',$imageName);
    }
}
