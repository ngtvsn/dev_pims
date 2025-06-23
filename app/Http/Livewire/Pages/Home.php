<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostLike;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    use WithPagination;
    public $postTitle;
    public $postContent;
    public $newComment = [];

    protected $listeners = ['showPostModal'];

    public function showPostModal()
    {
        $this->dispatchBrowserEvent('openPostModal');
    }

    public function likePost($postId)
    {
        $post = Post::findOrFail($postId);
        $existingLike = PostLike::where('post_id', $postId)->where('user_id', Auth::id())->first();

        if ($existingLike) {
            // Unlike the post
            $existingLike->delete();
        } else {
            // Like the post
            PostLike::create([
                'post_id' => $postId,
                'user_id' => Auth::id(),
            ]);
            Post::where('id', $postId)->update(['updated_at' => now()]);
        }
    }

    public function likeComment($commentId)
    {
        $comment = CommentLike::where('comment_id', $commentId)->where('user_id', Auth::id())->first();

        if ($comment) {
            $comment->delete(); // Unlike
        } else {
            CommentLike::create([
                'comment_id' => $commentId,
                'user_id' => Auth::id(),
            ]);

            
        }
    }

    public function createPost()
    {
        $this->validate([
            'postTitle' => 'required|max:255',
            'postContent' => 'required',
        ]);

        Post::create([
            'created_by' => Auth::id(),
            'title' => $this->postTitle,
            'content' => $this->postContent,
        ]);

        $this->reset(['postTitle', 'postContent']);
        $this->dispatchBrowserEvent('closePostModal');
    }

    public function addComment($postId)
    {
        $this->validate([
            "newComment.$postId" => 'required|string|max:500',
        ]);

        Comment::create([
            'post_id' => $postId,
            'created_by' => Auth::id(),
            'content' => $this->newComment[$postId],
        ]);

        Post::where('id', $postId)->update(['updated_at' => now()]);

        // Clear the input field
        $this->newComment[$postId] = '';

        // Refresh post data
        $this->emit('commentAdded');
    }
    
    public function render()
    {
        return view('livewire.pages.home', [
            'posts' => Post::with(['user_created', 'likes', 'comments.likes'])->orderBy('updated_at', 'desc')->paginate(10),
        ]);
    }
}
