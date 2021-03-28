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
        $key = $request->steganography_key;
        $filename = (storage_path('app/public/reveals/reveal.png'));
        $image = imagecreatefrompng($filename);
        $width = imagesx($image);
        $height = imagesy($image);
        $byte = [];
        $message = '';
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $rgb = imagecolorat($image, $i, $j);
                $blue = $rgb & 255;
                //echo "blue    ".decbin($blue)."<br>";
                $lsb = $blue & 1;
                //echo "lsb    ".$lsb."<br>";
                array_push($byte, $lsb);
                //echo "byte    ".var_dump($byte)."<br>";
                if (count($byte) == 8) {
                    //binary_string is a string that contains all the bits with zeros to the left of soon to be character
                    $binary_string = implode($byte);
                    //echo "binary_string:   " . $binary_string . "<br>";
                    //Check if the binary representation of the character is not 3 in ASCII, which is the end of text
                    if ($binary_string != "00000011") {
                        //decimal_value contains the ASCII value of the character
                        $decimal_value = bindec($binary_string);
                        //echo "decimal_value:   " . $decimal_value . "<br>";
                        if ($decimal_value > 9) {
                            //Convert the ASCII value to the actual character if it is not a digit
                            $decimal_value = chr($decimal_value);
                        }
                        $message .= $decimal_value;
                        //echo "message:   " . $message . "<br><br>";
                        $byte = [];
                    } else {
                        //If it is the end of text, stop reading the image
                        break 2;
                    }
                }
            }
        }
        $message = $this->polialphabetic_substitution($message, $key);
        $index = 'reveals.index';
        return view('components.message', compact('index', 'message'));
    }

    public function get_displacement(String $character)
    {
        $ascii_value = ord($character);
        $displacement = ($ascii_value % 27) + 1;
        return $displacement;
    }

    public function polialphabetic_substitution(String $message, String $key)
    {
        $displacement_alphabet1 = $this->get_displacement($key[0]);
        $displacement_alphabet2 = $this->get_displacement($key[1]);
        //echo "A1: " . $displacement_alphabet1 . "<br>";
        //echo "A2: " . $displacement_alphabet2 . "<br>";
        $is_pair = true;
        for ($i = 0; $i < strlen($message); $i++) {
            $character = $message[$i];
            //echo "Character: " . $character . "<br>";
            if (ctype_alpha($character)) {
                if ($is_pair) {
                    $character = $this->substitute_letter($character, $displacement_alphabet1);
                } else {
                    $character = $this->substitute_letter($character, $displacement_alphabet2);
                }
            }
            //echo "NewCharacter: " . $character . "<br><br>";
            $message[$i] = $character;
            $is_pair = !$is_pair;
        }
        return $message;
    }

    public function substitute_letter(String $letter, Int $displacement)
    {
        if (ctype_upper($letter)) {
            $floor = 65;
            $ceiling = 90;
        } else {
            $floor = 97;
            $ceiling = 122;
        }
        $ascii_value = ord($letter);
        //echo "ASCII: " . $ascii_value . "<br>";
        if (($ascii_value - $displacement) < $floor) {
            $new_ascii_value = (($ascii_value - $displacement) + ($ceiling - $floor + 1));
        } else {
            $new_ascii_value = ($ascii_value - $displacement);
        }
        //echo "ASCII: " . $new_ascii_value . "<br><br>";
        $new_letter = chr($new_ascii_value);
        return $new_letter;
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
            'steganography_key' => ['required', "min:2"],
            'steganography_image' => ['required', 'mimes:png'],

        ];
        return request()->validate($rules);
    }
}
