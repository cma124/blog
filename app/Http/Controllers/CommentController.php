<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    // Only for login user
    public function __construct() {
        $this->middleware('auth');
    }

    // Create new comment
    public function create() {
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->id();
        $comment->save();

        return back();
    }

    // Delete comment
    public function delete($id) {
        $comment = Comment::find($id);

        if(Gate::allows('comment-delete', $comment)) {
            $comment->delete();
            return back();
        } else {
            return back()->with('error', 'Unauthorized action !');
        }
    }
}
