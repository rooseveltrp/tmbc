<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = true;
    protected $table = 'comments';

    /**
     * Recursive method to get all the comments and its
     * children replies.
     * @param $parent_id    The id of a record.
     * @param int $level    A variable to keep track of the number of levels
     * @return array
     */
    public static function getAllNestedComments($parent_id, $level=0)
    {

        $items = Comment::where('parent_id', $parent_id)
            ->orderBy('created_at', 'ASC')
            ->get()
            ->toArray();
        $data = array();
        foreach ($items as $index => $item) {
            $id = $item['id'];
            $data[$id] = $item;
            $data[$id]['level'] = $level;
            $data[$id]['record_id'] = $id;
            $data[$id]['children'] = Comment::getAllNestedComments($id, $level + 1);
        }

        return $data;
    }

    /**
     * Method to automatically format the created_at date field.
     * @param $date
     * @return false|string
     */
    public function getCreatedAtAttribute($date)
    {
        return date("F d, Y h:i:s A", strtotime($date));
    }

    /**
     * Method to sanitize the user input before saving
     * them in the database.
     * @param $string   User Input
     * @return string   Sanitized String
     */
    public static function sanitize($string)
    {
        return htmlentities(strip_tags(trim($string)));
    }
}
