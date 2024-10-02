<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function upvote(Request $request)
    {
        $validatedData = $request->validate([
            'blog_id' => 'required|integer',
        ]);

        $user = Auth::user();
        if (!$user || !is_string($user->email)) {
            return redirect()->back()->withErrors('Invalid user data.');
        }

        $userEmail = (string) $user->email;
        $blogId = (int) $validatedData['blog_id'];
        $voteType = (int) 1;

        if (is_null($blogId) || !is_string($userEmail)) {
            return redirect()->back()->withErrors('Invalid input data.');
        }

        try {
            Vote::updateOrCreate(
                [
                    'blog_id' => $blogId, 
                    'user_email' => $userEmail
                ], 
                [
                    'vote_type' => $voteType
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error updating vote: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function downvote(Request $request)
    {
        $validatedData = $request->validate([
            'blog_id' => 'required|integer',
        ]);

        $user = Auth::user();
        if (!$user || !is_string($user->email)) {
            return redirect()->back()->withErrors('Invalid user data.');
        }

        $userEmail = (string) $user->email;
        $blogId = (int) $validatedData['blog_id'];
        $voteType = (int) -1;

        if (is_null($blogId) || !is_string($userEmail)) {
            return redirect()->back()->withErrors('Invalid input data.');
        }

        try {
            Vote::updateOrCreate(
                [
                    'blog_id' => $blogId, 
                    'user_email' => $userEmail
                ], 
                [
                    'vote_type' => $voteType
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error updating vote: ' . $e->getMessage());
        }

        return redirect()->back();
    }
}