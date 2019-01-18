<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        return view("comments.index");
    }

    public function all()
    {
        $comments = Comment::getAllNestedComments(null, 1);
        return response()->json([
            'data' => array(
                "full_name" => "root",
                "level" => 'root',
                "children" => $comments
            )
        ]);
    }

    public function save(Request $request)
    {

        $validateData = $request->validate([
            'full_name' => 'required|max:100|min:2',
            'comment' => 'required|max:500|min:2'
        ]);

        if ($validateData)
        {

            $item = new Comment;
            $item->full_name = Comment::sanitize($request->post('full_name'));
            $item->comment = Comment::sanitize($request->post('comment'));
            if ($request->post('parent_id')) {
                $item->parent_id = Comment::sanitize($request->post('parent_id'));
            }
            $item->save();

            return response()->json([
                "record_id" => $item->id
            ]);
        }
    }
}
