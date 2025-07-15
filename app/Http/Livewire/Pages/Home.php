<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostLike;
use App\Models\CommentLike;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    use WithPagination;

    public $postTitle;
    public $postContent;
    public $newComment = [];
    public $perPage = 10;
    public $totalPosts;

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

        $post = Post::create([
            'created_by' => Auth::id(),
            'title' => $this->postTitle,
            'content' => $this->postContent,
        ]);

        // Notify all users except the author
        $users = \App\Models\User::where('id', '!=', Auth::id())->get();
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'new_post',
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'author_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                ],
            ]);
        }

        $this->reset(['postTitle', 'postContent']);
        $this->emit('postCreated');
    }

    public function addComment($postId)
    {
        $this->validate([
            "newComment.$postId" => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'post_id' => $postId,
            'created_by' => Auth::id(),
            'content' => $this->newComment[$postId],
        ]);

        $post = Post::find($postId);
        if ($post->created_by !== Auth::id()) {
            Notification::create([
                'user_id' => $post->created_by,
                'type' => 'new_comment',
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'commenter_name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                ],
            ]);
        }

        Post::where('id', $postId)->update(['updated_at' => now()]);

        // Clear the input field
        $this->newComment[$postId] = '';

        // Refresh post data
        $this->emit('commentAdded');
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
    
    public function render()
    {
        $this->totalPosts = Post::count();
        return view('livewire.pages.home', [
            'posts' => Post::with(['user_created', 'likes', 'comments.likes'])->orderBy('updated_at', 'desc')->paginate($this->perPage),
        ]);
    }
}
