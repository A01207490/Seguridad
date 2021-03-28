<?php

namespace App\Http\Controllers;

use App\Reveal;
use Illuminate\Http\Request;

class RevealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reveals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if (!($request->file('steganography_image') == null)) {
            $request->file('steganography_image')->storeAs('reveals', 'reveal.png', 'public');
        }
        $filename = (storage_path('app/public/reveals/reveal.png'));
        $image = imagecreatefrompng($filename);
        $width = imagesx($image);
        $height = imagesy($image);
        $byte = [];
        $message = '';
        for ($i = 0; $i < $height; $i++) {
            $rgb = imagecolorat($image, $i, 1);
            $blue = $rgb & 255;
            //echo "blue    ".decbin($blue)."<br>";
            $lsb = $blue & 1;
            //echo "lsb    ".$lsb."<br>";
            array_push($byte, $lsb);
            //echo "byte    ".var_dump($byte)."<br>";
            if (count($byte) == 8) {
                //binary_string is a string that contains all the bits with zeros to the left of soon to be character
                $binary_string = implode($byte);
                echo "binary_string:   " . $binary_string . "<br>";
                //Check if the binary representation of the character is not 3 in ASCII, which is the end of text
                if ($binary_string != "00000011") {
                    //decimal_value contains the ASCII value of the character
                    $decimal_value = bindec($binary_string);
                    echo "decimal_value:   " . $decimal_value . "<br>";
                    if ($decimal_value > 9) {
                        //Convert the ASCII value to the actual character if it is not a digit
                        $decimal_value = chr($decimal_value);
                    }
                    $message .= $decimal_value;
                    echo "message:   " . $message . "<br><br>";
                    $byte = [];
                } else {
                    //If it is the end of text, stop reading the image
                    break;
                }
            }
        }
        $index = 'reveals.index';
        return view('components.message', compact('index', 'message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reveal  $reveal
     * @return \Illuminate\Http\Response
     */
    public function show(Reveal $reveal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reveal  $reveal
     * @return \Illuminate\Http\Response
     */
    public function edit(Reveal $reveal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reveal  $reveal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reveal $reveal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reveal  $reveal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reveal $reveal)
    {
        //
    }
    public function validateForm()
    {
        $rules = [
            'steganography_key' => ['required'],
            'steganography_image' => ['required', 'mimes:png'],

        ];
        return request()->validate($rules);
    }
}
