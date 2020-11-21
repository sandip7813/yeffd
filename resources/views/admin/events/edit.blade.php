@extends('layouts.admin')

@section('title')
    Edit Event
@endsection

@section('content')

    <div class="module">
        <div class="module-head">
            <h3>Edit Event</h3>
        </div>

        <div class="module-body">
            <br />
            @if(Session::has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success') }}</strong>
                @php
                    Session::forget('success');
                @endphp
            </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="pic_upload_form" method="POST" action="{{ route( $route_prefix . 'update', $event->id) }}" enctype="multipart/form-data" class="form-horizontal row-fluid">
                @method('PATCH')
                @csrf

                <div class="control-group">
                    <label class="control-label" for="event_title">Event Title</label>
                    <div class="controls">
                        <input type="text" name="event_title" id="event_title" placeholder="Event Title" class="span8" value="{{ $event->event_title }}">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="event_description">Event Details</label>
                    <div class="controls">
                        <textarea name="event_description" id="event_description" placeholder="Event Details" rows="5" class="span8">{{ $event->event_description }}</textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="event_date">Event Date</label>
                    <div class="controls">
                        <input type="text" name="event_date" id="event_date" placeholder="Event Date" class="span8" value="{{ $event->event_date }}">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="Picture">Attach Picture</label>
                    <div class="controls">
                        <input type="file" name="event_pictures[]" id="event_pictures" class="form-control" multiple>
                        <div class="alert alert-error" id="picture_size_error" style="display:none;"></div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" id="upload_btn" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>

            <div class="control-group">
                <label class="control-label" for="Picture">Pictures</label>
                <div class="controls">
                    @foreach($event->pictures as $event_pic)
                        <div style="width:auto; display:inline-block; margin-right:20px;">
                            @if( $event_pic->file_extn == 'mp4' )
                                <img src="/images/play-button.png" alt="image" style="max-width:80px;">
                            @else
                                <img src="/{{ $img_dir . $thumbnail_dir . $event_pic->mod_image }}" alt="image" style="max-width:80px;">
                            @endif

                            <br> &nbsp;
                            
                            @if($event_pic->is_dp == 0)
                            <div class="media-option btn-group shaded-icon">
                                <form action="{{ route( $route_prefix . 'delete-picture', $event_pic->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" onclick="return confirm('Are you sure to delete this?');" class="btn btn-small" data-toggle="tooltip" data-placement="right" title="Delete this Picture.">
                                        <i class="icon-trash"></i>
                                    </button>

                                    <a onclick="return confirm('Are you sure to make this DP?');" href="{{ route( $route_prefix . 'event-picture-dp', $event_pic->id) }}" class="btn btn-small" data-toggle="tooltip" data-placement="right" title="Make DP">
                                        <i class="icon-edit"></i>
                                    </a>
                                </form>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <br />

@endsection

@push('scripts')
<script>
    //+++++++++++++++++ ATTACH PICTURES :: Start +++++++++++++++++//
    $('#event_pictures').bind('change', function() {
        $('#picture_size_error').html('').hide();

        max_allowed_MB      = 30;
        one_MB_in_Byte      = 1048576;
        max_allowed_size    = max_allowed_MB * one_MB_in_Byte; //in MB
        file_size           = 0;

        for (var i = 0; i < this.files.length; i++) {
            file_size   += this.files[i].size;
        }

        if(file_size >= max_allowed_size){
            uploaded_mb = parseInt( file_size / one_MB_in_Byte );

            $('#picture_size_error').show().html('<strong>Total Selected: '+uploaded_mb+' MB. <br>Max '+max_allowed_MB+' MB Upload Allowed.</strong>');

            $('#event_pictures').val('');

            return false;
        }
    });
    //+++++++++++++++++ ATTACH PICTURES :: End +++++++++++++++++//
</script>
@endpush