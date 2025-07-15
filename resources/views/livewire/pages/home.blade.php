<div>
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
        }
        .form-control-plaintext {
            cursor: pointer;
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: #f0f2f5;
            transition: background-color 0.2s ease;
        }
        .form-control-plaintext:hover {
            background-color: #e4e6e9;
        }
        .post-card, .comment-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        .post-actions .btn {
            font-weight: 600;
            color: #65676b;
        }
        .post-actions .btn:hover {
            background-color: #f0f2f5;
        }
        .comment-input {
            background-color: #f0f2f5;
            border-radius: 2rem;
            border: none;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .initials-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <!-- Create Post Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="initials-circle mr-3" style="background-color: hsl({{ crc32(Auth::id()) % 360 }}, 50%, 50%);">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1" wire:click="$emit('showPostModal')">
                            <input type="text" class="form-control-plaintext" placeholder="What's on your mind, {{ Auth::user()->first_name }}?">
                        </div>
                    </div>
                </div>

                <!-- Display Posts -->
                @forelse($posts as $post)
                    <div class="card post-card mb-4">
                        <div class="card-body">
                            <!-- Post Header -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="initials-circle mr-3" style="background-color: hsl({{ crc32($post->user_created->id) % 360 }}, 50%, 50%);">
                                    {{ strtoupper(substr($post->user_created->first_name, 0, 1) . substr($post->user_created->last_name, 0, 1)) }}
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold">{{ $post->user_created->first_name }} {{ $post->user_created->last_name }}</h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }} · {{ $post->user_created->division->division_name }}</small>
                                </div>
                            </div>

                            <!-- Post Content -->
                            <h5 class="mb-3">{{ $post->title }}</h5>
                            <p style="white-space: pre-wrap; word-wrap: break-word;">{{ $post->content }}</p>

                            <!-- Post Stats -->
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div>
                                    @if($post->likes->count() > 0)
                                        <i class="fas fa-thumbs-up text-primary"></i>
                                        {{ $post->likes->count() }}
                                    @endif
                                </div>
                                <div>
                                    {{ $post->comments->count() }} comments
                                </div>
                            </div>
                            <hr class="my-1">

                            <!-- Post Actions -->
                            <div class="d-flex justify-content-around post-actions">
                                <button type="button" class="btn btn-link text-decoration-none w-100 {{ $post->isLikedByUser() ? 'text-primary' : 'text-muted' }}" wire:click="likePost({{ $post->id }})">
                                    <i class="far fa-thumbs-up me-2"></i> Like
                                </button>
                                <button type="button" class="btn btn-link text-decoration-none text-muted w-100">
                                    <i class="far fa-comment me-2"></i> Comment
                                </button>
                            </div>
                            <hr class="my-1">

                            <!-- Comments Section -->
                            @foreach($post->comments as $comment)
                                <div class="d-flex mt-3">
                                    <div class="initials-circle mr-3" style="background-color: hsl({{ crc32($comment->user_created->id) % 360 }}, 40%, 60%); width:32px; height:32px; font-size: 0.8rem;">
                                        {{ strtoupper(substr($comment->user_created->first_name, 0, 1) . substr($comment->user_created->last_name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="bg-light p-2 rounded">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-bold">{{ $comment->user_created->first_name }} {{ $comment->user_created->last_name }}</span>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{{ $comment->content }}</p>
                                        </div>
                                        <div class="small ps-2">
                                            <a href="#" class="text-muted text-decoration-none {{ $comment->isLikedByUser() ? 'text-primary fw-bold' : '' }}" wire:click.prevent="likeComment({{ $comment->id }})">Like</a>
                                            @if($comment->likes->count() > 0)
                                                <span class="text-muted ms-1">· {{ $comment->likes->count() }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Add Comment -->
                            <div class="d-flex align-items-center mt-3">
                                <div class="initials-circle mr-3" style="background-color: hsl({{ crc32(Auth::id()) % 360 }}, 40%, 60%); width:32px; height:32px; font-size: 0.8rem;">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                                </div>
                                <div class="input-group ms-3">
                                    <input type="text" class="form-control comment-input" placeholder="Write a comment..." wire:model.defer="newComment.{{ $post->id }}" wire:keydown.enter="addComment({{ $post->id }})">
                                    <button class="btn btn-link" wire:click="addComment({{ $post->id }})"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card text-center">
                        <div class="card-body">
                            <p class="mb-0">No announcements yet. Be the first to post!</p>
                        </div>
                    </div>
                @endforelse

                @if(count($posts) < $totalPosts)
                    <div x-data="{
                        observe () {
                            let observer = new IntersectionObserver((entries) => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        @this.call('loadMore')
                                    }
                                })
                            }, {
                                root: null
                            })
                            observer.observe(this.$el)
                        }
                    }" x-init="observe"></div>
                @endif

                <div wire:loading wire:target="loadMore" class="text-center">
                    Loading more posts...
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Creating Post -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Create Announcement</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="initials-circle mr-3" style="background-color: hsl({{ crc32(Auth::id()) % 360 }}, 50%, 50%);">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                            <small class="text-muted">Posting publicly</small>
                        </div>
                    </div>
                    <input type="text" class="form-control mb-3" placeholder="Title" wire:model.defer="postTitle">
                    <textarea class="form-control" rows="5" placeholder="What's on your mind, {{ Auth::user()->first_name }}?" wire:model.defer="postContent" disable></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100" wire:click="createPost" wire:loading.attr="disabled">
                        Post
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            var postModal = new bootstrap.Modal(document.getElementById('postModal'));

            Livewire.on('showPostModal', () => {
                postModal.show();
            });

            Livewire.on('postCreated', () => {
                postModal.hide();
            });
        });
    </script>
    @endpush
</div>
