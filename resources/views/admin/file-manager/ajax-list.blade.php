<ul id="mediafiles-list" class="flex-wrap p-0 m-0 ok d-flex justify-content-between w-100" style="list-style: none;">

@foreach ($medias as $media)
    <li class="d-inline-block get-all-media">
        <input @if($type == 'single') type="radio" @else type="checkbox" @endif name="media[]" id="mediaid{{$media->id}}" value="{{$media->id}}"/>
        <label for="mediaid{{$media->id}}" id="getmedia-{{$media->id}}">
            <img class="d-block" src="{{asset($media->file)}}" alt="{{$media->name}}">
        </label>
    </li>
@endforeach

</ul>


