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
        $steganography_key = $request->steganography_key;
        if (!($request->file('steganography_image') == null)) {
            $request->file('steganography_image')->storeAs('steganography', $steganography->id . '.png', 'public');
        }
        $steganography_message = $this->polialphabetic_substitution($steganography_message, $steganography_key);
        $filename = (storage_path('app/public/steganography/' . $steganography->id . '.png'));
        $image = imagecreatefrompng($filename);
        $width = imagesx($image);
        $height = imagesy($image);
        // The array in which we store all the bits of each individal character of the message, this includes the zeros to the left, e.g character "2", which is 10 in binary, is added to the array as 0000000010
        $message_bits = [];
        // Auxiliary array that has the posibly needed zeros to the left of each binary_string
        $binary_array_padding = [0, 0, 0, 0, 0, 0, 0, 0];
        // Array that contains each character of binary_string without zeros to the left, e.g [1, 0] for "10"
        $binary_array = [];
        for ($i = 0; $i < strlen($steganography_message); $i++) {
            //Get the current character to be decomposed
            $current_character = $steganography_message[$i];
            //Check of if the current character is a digit or not
            if (!(ctype_digit($steganography_message[$i]))) {
                //If the character is not a digit, get it's ASCII value, e.g for "a", the function ord would return 97
            }
            //This was taken out of the if even if it makes no sense, but it's what works :'v
            //Saul's response:
            //https://cdn.discordapp.com/attachments/705502843192344649/825852090155925504/dsmGaKWMeHXe9QuJtq_ys30PNfTGnMsRuHuo_MUzGCg.png
            $current_character = ord($current_character);
            //echo "character: " . $current_character . "<br>";
            //At this point, current_character has either digits [0-9], or ASCII values
            //Turn these values into their binary equivalent with decbin
            //binary_string is a string that contains the binary representation of the values, e.g for 97, the string would be "1100001"
            //These shit doesn't make sense
            //darle a decbin, ord de un string, trata el string como Dec en la tabla ASCII
            //darle a decbin, solo un string, trata el string como Chr de la tabla ASCII
            //darle a decbin, un int, trata el int como Dec de la tabla ASCII
            $binary_string = decbin($current_character);
            //echo "binary value: " . $binary_string . "<br>";
            //Split each character of binary_string and allocate them into an array, e.g for "1100001" the array would be [1, 1, 0, 0, 0, 0, 1]
            $binary_array = str_split($binary_string, 1);
            //echo "binary array: " . var_dump($byte_array) . "<br>";
            for ($j = 0; $j < count($binary_array); $j++) {
                //Here we add the bits in reverse order
                //10
                //0000000010
                //Since we need to overwrite the values of the array with zeros from the last position, we also start to read 10 from the last position, which is zero. That way, we add 0 to the least significative bit, meaning to the rightmost side of the array with padding
                $binary_array_padding[7 - $j] = intval($binary_array[count($binary_array) - 1 - $j]);
            }
            //We add the current byte with padding to the array that contains all the bytes of the message
            $message_bits = array_merge($message_bits, $binary_array_padding);
            //echo $byte."<br>";
            //echo var_dump($binary_array_padding)."<br><br>";
            $binary_array_padding = [0, 0, 0, 0, 0, 0, 0, 0];
        }

        $message_bits = array_merge($message_bits, [0, 0, 0, 0, 0, 0, 1, 1]);
        //echo var_dump($message_bits) . "<br><br>";
        $length = count($message_bits);
        $count = 0;
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                if ($count == $length) {
                    break 2;
                }
                $rgb = imagecolorat($image, $i, $j);
                $blue = $rgb & 255;
                $lsb = $blue & 1;
                if ($lsb != $message_bits[$count]) {
                    $result = 1 ^ $rgb;
                } else {
                    $result = $rgb;
                }
                imagesetpixel($image, $i, $j, $result);
                $count++;
            }
        }
        imagepng($image, $filename, 9);
        /*
        $red = ($rgb >> 16) & 255;
        $green = ($rgb >> 8) & 255;
        printf($format, $result, 1, '^', $blue);
        */
        $index = 'steganographies.index';
        return view('components.success', compact('index'));
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
        $is_pair = true;
        for ($i = 0; $i < strlen($message); $i++) {
            $character = $message[$i];
            if (ctype_alpha($character)) {
                if ($is_pair) {
                    $character = $this->substitute_letter($character, $displacement_alphabet1);
                } else {
                    $character = $this->substitute_letter($character, $displacement_alphabet2);
                }
            }
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
        if (($ascii_value + $displacement) > $ceiling) {
            $new_ascii_value = (($ascii_value + $displacement) - ($ceiling - $floor + 1));
        } else {
            $new_ascii_value = ($ascii_value + $displacement);
        }
        $new_letter = chr($new_ascii_value);
        return $new_letter;
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
        $this->destroy_image($steganography);
        Steganography::destroy($steganography->id);
        $index = 'steganographies.index';
        return view('components.success', compact('index'));
    }

    public function destroy_image(Steganography $steganography)
    {
        $image = storage_path('app/public/steganography/' . $steganography->id . '.png');
        if (file_exists($image)) {
            unlink($image);
        }
    }

    public function validateForm()
    {
        $rules = [
            'steganography_key' => ['required', "min:2"],
            'steganography_message' => ['required'],
            'steganography_image' => ['required', 'mimes:png'],

        ];
        return request()->validate($rules);
    }
}
