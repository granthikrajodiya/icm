{{-- user info and avatar --}}
@if (!empty(user()->avatar))
    <div class="avatar av-l"
         style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').user()->avatar) }}');"></div>
@else
    <div class="avatar av-l"
         style="background-image: url('{{ asset('/storage/'.config('chatify.user_avatar.folder').'avatars/avatar.png') }}');">
    </div>
@endif
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    {{-- <a href="#" class="default"><i class="fas fa-camera"></i> default</a> --}}
    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> {{__('Delete Conversation')}}</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title">{{__('shared photos')}}</p>
    <div class="shared-photos-list"></div>
</div>
