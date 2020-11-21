@extends('layouts.admin')

@section('title')
    Success Stories
@endsection

@section('content')
    
    <div class="module">
        <div class="module-head">
            <h3>Success Stories</h3>
        </div>
        <div class="module-body">

            @if(Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ Session::get('success') }}</strong>
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>Story Title</th>
                    <th>Active</th>
                    <th style="text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($storiesArr as $key => $story)
                        <tr>
                            <td style="text-align:center;">
                                @if( $story->dp_pictures->file_extn == 'mp4' )
                                    <img src="/images/play-button.png" alt="image" style="height:100px;">
                                @else
                                    <img src="/{{ $img_dir . $thumbnail_dir . $story->dp_pictures->mod_image }}" alt="image" style="height:100px;">
                                @endif
                            </td>
                            <td>{{ $story->story_title }}</td>
                            <td style="text-align: center;"><input type="checkbox" class="change_status" id="status_{{$story->id}}" @if($story->status == 1) checked @endif></td>
                            <td>
                                <form action="{{ route( $route_prefix . 'destroy', $story->id ) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    
                                    <div class="media-option btn-group shaded-icon">
                                        <a href="{{ route( $route_prefix . 'edit', $story->id ) }}" class="btn btn-small" data-toggle="tooltip" data-placement="right" title="Edit this Story">
                                            <i class="icon-edit"></i>
                                        </a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete this story?');" class="btn btn-small" data-toggle="tooltip" data-placement="right" title="Delete this Story.">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            
        </div>
    </div>

    <br />

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.change_status').click(function(){
        story_status = '';
        
        if( $(this).prop('checked') == true ){
            story_status = 'active';
        }
        else if( $(this).prop('checked') == false) {
            story_status = 'inactive';
        }
        
        if( confirm('Are you sure to make this story '+ story_status+'?') ){
            item_id_string  = $(this).attr('id');

            item_id_split   = item_id_string.split('_');
            story_id        = item_id_split[1];

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                    dataType: 'json',
                    type:'POST',
                    url:'/change-story-status',
                    data:{story_id: story_id, story_status: story_status},
                    success:function(data) {
                        if(data.status == 'success'){
                            alert('Story status has been changed to '+ story_status);
                        }
                    }
            });
        }
        else{
            return false;
        }
    });
});
</script>
@endpush
