<?php

namespace App\Http\Controllers;

use App\Steganography;
use Illuminate\Http\Request;
use \App\Tables\SteganographiesTable;
use Illuminate\Support\Facades\Storage;
use Response;


class SteganographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new SteganographiesTable)->setup();
        return view('steganographies.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('steganographies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $format = '(%1$2d = %1$04b) = (%2$2d = %2$04b)' . ' %3$s (%4$2d = %4$04b)' . "\n";
        $this->validateForm();
        $steganography = Steganography::create(([
            'steganography_key' => $request->steganography_key,
            'steganography_message' => $request->steganography_message,
        ]));
        $steganography_message = $request->steganography_message;
        if(!($request->file('steganography_image') == null)){
            $request->file('steganography_image')->storeAs('steganography', $steganography->id . '.png', 'public');
        }
        $filename = (storage_path('app/public/steganography/' . $steganography->id . '.png'));
        $image = imagecreatefrompng($filename);
        $width = imagesx($image);
        $height = imagesy($image);
        for ($i=0; $i < strlen($steganography_message); $i++) { 
            $rgb = imagecolorat($image,$i,1);
            $blue = $rgb & 255;
            $lsb = ($blue >> 1) & 1;
            if($lsb != $steganography_message[$i]){
                $result = 1 ^ $rgb;
            }else{
                $result = $rgb;
            }
            imagesetpixel($image,$i,1,$result);
        }
        imagepng($image,$filename,9);
        /*
        $red = ($rgb >> 16) & 255;
        $green = ($rgb >> 8) & 255;
        printf($format, $result, 1, '^', $blue);
        */
        $index = 'steganographies.index';
        return view('components.success', compact('index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Steganography  $steganography
     * @return \Illuminate\Http\Response
     */
    public function show(Steganography $steganography)
    {
        $steganography = Steganography::find($steganography->id);
        return response()->download(storage_path('app/public/steganography/' . $steganography->id . '.png'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Steganography  $steganography
     * @return \Illuminate\Http\Response
     */
    public function edit(Steganography $steganography)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Steganography  $steganography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Steganography $steganography)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Steganography  $steganography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Steganography $steganography)
    {
        //
    }

    public function validateForm()
    {
        $rules = [
            'steganography_key' => ['required'],
            'steganography_message' => ['required'],
            'steganography_image' => ['required','mimes:png'],

        ];
        return request()->validate($rules);
    }
}
