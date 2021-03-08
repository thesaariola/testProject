<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function index()
   {
	   
		// Get all comments and replies 
		$comments = Comment::with([
			'children',
			'children.children',
			'children.children.children'
		])
		->isParent()
		->latest()
		->get();
	   
		// Return collection of comment as a resource
		return CommentResource::collection($comments);
	   
   }	   
   
    public function post(Request $request)
    {
       
        // Check if submitted entries are valid
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3',
            'comment' => 'required|min:1'
        ]);

        // Redirect to Home page
        if ($validator->fails()) {

            return Response::json(['success' => false]); 

        }
        else{
            // Save post comment
            Comment::create([
                'username' => $request->username,
                'comment' => $request->comment
            ]);

            return Response::json(['success' => true]);
        }
        
    }

    public function postReply(Request $request)
    {
       
		$request->username = (isset($request->user) ? $request->user : "Anonymous");
        
		// Save comment reply
		Comment::create([
			'username' => $request->username,
			'comment' => $request->reply,
			'parent_id' => $request->id
		]);

		return Response::json(['success' => true]);

    }
}
