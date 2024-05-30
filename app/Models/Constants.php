<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Constants extends Model
{
    use HasFactory;

    /**
     * Get a list of states from the states.txt file in the storage folder.
     * @return array
     */
    public static function getStates(): array
    {
        $states = array();
        $content = fopen(Storage::path('states.txt'), 'r');

        while (!feof($content)) {

            $line = fgets($content);
            
            $states[] = $line;

        }

        fclose($content);

        return $states;
    }
}
