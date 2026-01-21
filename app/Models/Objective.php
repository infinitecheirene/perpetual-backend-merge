<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Objective extends Model
=======
class MissionAndVision extends Model
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'about_section';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
<<<<<<< HEAD
        'objectives_header',
        'objectives_title',
        'objectives_description',
        'objectives_card_title',
        'objectives_card_content',
=======
        'mission_and_vision_header',
        'mission_and_vision_title',
        'mission_and_vision_description',
        'mission_content',
        'vision_content',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
<<<<<<< HEAD
        'objectives_card_title' => 'array',
        'objectives_card_content' => 'array',
=======
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
<<<<<<< HEAD
     * Check if the objectives section is empty
     */
    public static function isObjectivesSectionEmpty()
=======
     * Check if the mission and vision section is empty
     */
    public static function isMissionVisionSectionEmpty()
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
    {
        $record = self::first();

        if (!$record) {
<<<<<<< HEAD
            return true;
        }

        return empty($record->objectives_header) &&
            empty($record->objectives_title) &&
            empty($record->objectives_description) &&
            empty($record->objectives_card_title) &&
            empty($record->objectives_card_content);
    }

    /**
     * Get or create the objectives record
=======
            return true; // Table is completely empty
        }

        // Check if all mission and vision columns are null or empty
        return empty($record->mission_and_vision_header) &&
            empty($record->mission_and_vision_title) &&
            empty($record->mission_and_vision_description) &&
            empty($record->mission_content) &&
            empty($record->vision_content);
    }

    /**
     * Get or create the mission and vision record
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
     */
    public static function getOrCreateRecord()
    {
        $record = self::first();

        if (!$record) {
<<<<<<< HEAD
            $record = self::create([
                'objectives_header' => '',
                'objectives_title' => '',
                'objectives_description' => '',
                'objectives_card_title' => [],
                'objectives_card_content' => [],
=======
            // Create new record if table is empty
            $record = self::create([
                'mission_and_vision_header' => '',
                'mission_and_vision_title' => '',
                'mission_and_vision_description' => '',
                'mission_content' => '',
                'vision_content' => '',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);
        }

        return $record;
    }
}