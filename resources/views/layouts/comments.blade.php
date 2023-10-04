@foreach($comments as $comment )
<div class="card {{ ! $loop->first ? 'mt-3' : '' }}">
    <div class="card-header d-flex justify-content-between">
        <div class="commenter d-flex justify-content-between">
            <div class="mr-4">
                <span>
                    {{ $comment->user->name }}
                </span>
            </div>
            <div class="mr-4">
                <span class="text-muted ">
                    {{timeAgo($comment->created_at)}}
                </span>
            </div>
        </div>
        @auth
            <button type="submit" class="btn btn-sm btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendComment" data-id="{{ $comment->id }}">Reply</button>
        @endauth
    </div>

    <div class="card-body">
        {{ $comment->comment }}
        {{-- @foreach($comment->child as $childComment)
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="commenter">
                        <span>{{ $childComment->user->name }}</span>
                        <span class="text-muted">- دو دقیقه قبل</span>
                    </div>
                </div>

                <div class="card-body">
                    {{ $childComment->comment }}
                </div>
            </div>
        @endforeach --}}

        @include('layouts.comments' , ['comments' => $comment->child])
    </div>
</div>
@endforeach
