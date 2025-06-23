<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <style>
        .form-rounded {
            border-radius: 2rem;
        }
    </style>  

    <div class="content" wire:poll.5s>
        <div class="container">
            <div class="row justify-content-md-center pt-3">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <span class="ml-1 font-weight-bold">{{ Auth::user()->last_name.', '.Auth::user()->first_name }}</span>
                            <span class="font-italic ml-1">({{ Auth::user()->email }})</span>
                            <input class="form-control form-rounded mt-2" id="enabledInput" type="text" placeholder="What's on your mind, {{ Auth::user()->last_name.', '.Auth::user()->first_name }}?" disabled onclick="enableInput()">
                                <hr>
                            <!-- Instead of direct input, trigger modal -->
                            <button type="button" class="btn btn-light btn-block mt-2" 
                                    wire:click="$emit('showPostModal')">
                                <i class="fas fa-paper-plane mr-2"></i> Create post
                            </button>
                        </div>
                    </div>

                    <!-- Display Posts -->
                    @foreach($posts as $post)
                        <div class="card mt-3">
                            <div class="card-body">
                                <span class="ml-1 font-weight-bold">{{ $post->user_created->division->division_name }}</span>
                                <hr>
                                <span class="ml-1 font-weight-bold">{{ $post->user_created->last_name.', '.$post->user_created->first_name }}</span>
                                <span class="font-italic ml-1">({{ $post->user_created->email }})</span>
                                <small class="ml-1 float-right">{{ $post->created_at->diffForHumans() }}</small>
                                <br>
                                <h6 class="my-4 ml-1">{{ $post->title }}</h6>
                                <div class="my-2 ml-1" style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit;">{{ $post->content }}</div>

                                <div class="row">
                                    <div class="col-6" style="display: flex; align-items: center;">
                                            @if($post->isLikedByUser())
                                            <button class="btn btn-success btn-sm rounded-circle">
                                                <i class="fas fa-thumbs-up"></i>
                                            </button>
                                            @else
                                            <button class="btn btn-secondary btn-sm rounded-circle">
                                                <i class="far fa-thumbs-up"></i>
                                            </button>
                                            @endif
                                        
                                        <a href="#" class="ml-2 text-secondary">{{ $post->likes->count() }}</a>
                                    </div>
                                    <div class="col-6" style="align-items: center;">
                                        <a href="#" class="text-secondary float-right">{{ $post->comments->count() }} comments</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">

                                        @if($post->isLikedByUser())
                                                <button type="button" class="btn btn-light text-success btn-block" wire:click="likePost({{ $post->id }})"><i class="fas fa-thumbs-up text-success mr-2"></i>Like</button>
                                            @else
                                                <button type="button" class="btn btn-light btn-block" wire:click="likePost({{ $post->id }})"><i class="far fa-thumbs-up mr-2"></i>Like</button>
                                            @endif
                                        
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-light btn-block"><i class="far fa-comment mr-2"></i>Comment</button>
                                    </div>
                                </div>
                                
                                <hr>

                                <!-- Display Comments -->
                                @foreach($post->comments as $comment)
                                    <div class="card rounded-9 mt-2">
                                        <div class="card-body rounded-9" style="background-color:#f0f2f5;">
                                            <span class="font-weight-bold">{{ $comment->user_created->last_name.', '.$comment->user_created->first_name }}</span>
                                            <span class="font-italic ml-1">({{ $comment->user_created->email }})</span>
                                            <small class="float-right">{{ $comment->created_at->diffForHumans() }}</small>
                                            <br>
                                            <span>{{ $comment->content }}</span>
                                            <div class="mt-2">
                                                @if($comment->isLikedByUser())
                                                    <a href="#" class="text-success font-weight-bold" wire:click="likeComment({{ $comment->id }})">Like</a>
                                                    <span class="text-secondary ml-2">{{ $comment->likes->count() }}</span>
                                                    <i class="fas fa-thumbs-up fa-xs text-success"></i>
                                                @else
                                                    <a href="#" class="text-secondary" wire:click="likeComment({{ $comment->id }})">Like</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div>
                                    <div class="row" style="align-items: center;">
                                        <div class="col-11">
                                        <input class="form-control form-rounded" id="enabledInput" type="text" placeholder="Comment as {{ Auth::user()->last_name.', '.Auth::user()->first_name }}?" wire:model.defer="newComment.{{ $post->id }}">
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-link btn-block" wire:click="addComment({{ $post->id }})"><i class="fas fa-paper-plane text-success"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Creating Post -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Create a Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <span class="ml-1 font-weight-bold">{{ Auth::user()->last_name.', '.Auth::user()->first_name }}</span>
                        <span class="font-italic ml-1">({{ Auth::user()->email }})</span>
                    </div>
                    
                    <input type="text" class="form-control mb-2" placeholder="Title" wire:model.defer="postTitle">
                    <textarea class="form-control" placeholder="What's on your mind?" wire:model.defer="postContent"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success w-100 d-flex align-items-center justify-content-center" wire:click="createPost" wire:loading.attr="disabled">
                        <i class="fas fa-paper-plane mr-2"></i>Post</button>
                </div>
            </div>
        </div>
    </div>
</div>