@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="btn-controls">
        <h1>Dashboard</h1>

        <h3>Welcome to Y.E.F.F.D Admin Panel</h3>
        
        <div class="btn-box-row row-fluid">
            <a href="{{ route('admin.events.index') }}" class="btn-box big span4"><i class=" icon-group"></i><b>Events</b></a>
            <a href="{{ route('admin.success-stories.index') }}" class="btn-box big span4"><i class="icon-bullhorn"></i><b>Success Stories</b></a>
            <a href="{{ route('admin.donations') }}" class="btn-box big span4"><i class="icon-money"></i><b>Donations</b></a>
        </div>
    </div>

    <br />



@endsection