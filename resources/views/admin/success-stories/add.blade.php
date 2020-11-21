@extends('layouts.admin')



@section('title')

    Add Success Story

@endsection



@section('content')

    

    <div class="module">

        <div class="module-head">

            <h3>Add Success Story</h3>

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



                <form id="pic_upload_form" method="POST" action="{{ route( $route_prefix . 'store' ) }}" enctype="multipart/form-data" class="form-horizontal row-fluid">

                    @csrf



                    <div class="control-group">

                        <label class="control-label" for="story_title">Story Title</label>

                        <div class="controls">

                            <input type="text" name="story_title" id="story_title" placeholder="Story Title" class="span8" value="{{ old('story_title') }}">

                        </div>

                    </div>



                    <div class="control-group">

                        <label class="control-label" for="story_description">Story Details</label>

                        <div class="controls">

                            <textarea name="story_description" id="story_description" placeholder="Story Details" rows="5" class="span8">{{ old('story_description') }}</textarea>

                        </div>

                    </div>


                    <div class="control-group">

                        <label class="control-label" for="Picture">Attach Picture</label>

                        <div class="controls">

                            <input type="file" name="story_pictures[]" id="story_pictures" class="form-control" multiple>

                            <div class="alert alert-error" id="picture_size_error" style="display:none;"></div>

                        </div>

                    </div>



                    <div class="control-group">

                        <div class="controls">

                            <button type="submit" id="upload_btn" class="btn btn-success">Upload</button>

                        </div>

                    </div>

                </form>

        </div>

    </div>



    <br />



@endsection



@push('scripts')

<script>

    //+++++++++++++++++ ATTACH PICTURES :: Start +++++++++++++++++//

    $('#story_pictures').bind('change', function() {

        $('#picture_size_error').html('').hide();

        max_allowed_MB      = 30;

        one_MB_in_Byte      = 1048576;

        max_allowed_size    = max_allowed_MB * one_MB_in_Byte; //in MB

        file_size   = 0;

        for (var i = 0; i < this.files.length; i++) {
            file_size   += this.files[i].size;
        }

        if(file_size >= max_allowed_size){

            uploaded_mb = parseInt( file_size / one_MB_in_Byte );

            $('#picture_size_error').show().html('<strong>Total Selected: '+uploaded_mb+' MB. <br>Max '+max_allowed_MB+' MB Upload Allowed.</strong>');

            $('#story_pictures').val('');

            return false;

        }

    });

    //+++++++++++++++++ ATTACH PICTURES :: End +++++++++++++++++//

</script>

@endpush