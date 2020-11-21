@extends('layouts.admin')

@section('title')
    Events
@endsection

@section('content')
    
    <div class="module">
        <div class="module-head">
            <h3>Events</h3>
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
                    <th>Event Title</th>
                    <th>Active</th>
                    <th style="text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($eventsArr as $key => $event)
                        <tr>
                            <td style="text-align:center;">
                                @if( $event->dp_pictures->file_extn == 'mp4' )
                                    <img src="/images/play-button.png" alt="image" style="height:100px;">
                                @else
                                    <img src="/{{ $img_dir . $thumbnail_dir . $event->dp_pictures->mod_image }}" alt="image" style="height:100px;">
                                @endif
                            </td>
                            <td>{{$event->event_title}}</td>
                            <td style="text-align: center;"><input type="checkbox" class="change_status" id="status_{{$event->id}}" @if($event->status == 1) checked @endif></td>
                            <td>
                                <form action="{{ route( $route_prefix . 'destroy', $event->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    
                                    <div class="media-option btn-group shaded-icon">
                                        <a href="{{ route( $route_prefix . 'edit', $event->id) }}" class="btn btn-small" data-toggle="tooltip" data-placement="right" title="Edit this Event">
                                            <i class="icon-edit"></i>
                                        </a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete this event?');" class="btn btn-small" data-toggle="tooltip" data-placement="right" title="Delete this Event.">
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
        event_status = '';
        
        if( $(this).prop('checked') == true ){
            event_status = 'active';
        }
        else if( $(this).prop('checked') == false) {
            event_status = 'inactive';
        }
        
        if( confirm('Are you sure to make this event '+ event_status+'?') ){
            item_id_string   = $(this).attr('id');

            item_id_split   = item_id_string.split('_');
            event_id        = item_id_split[1];

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                    dataType: 'json',
                    type:'POST',
                    url:'/change-event-status',
                    data:{event_id: event_id, event_status: event_status},
                    success:function(data) {
                        if(data.status == 'success'){
                            alert('Event status has been changed to '+ event_status);
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
