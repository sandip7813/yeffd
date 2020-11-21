@extends('layouts.admin')

@section('title')
    Donations
@endsection

@section('content')
    
    <div class="module">
        <div class="module-head">
            <h3>Donations</h3>
        </div>
        <div class="module-body">
            
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email / Mobile</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Payment ID</th>
                    <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($donationsArr as $key => $donate)
                        <tr>
                            <td>{{ $donate->first_name . ' ' . $donate->last_name }}</td>
                            <td>{{ $donate->email_id }} <br> {{ $donate->mobile_num }}</td>
                            <td>{{ $donate->donation_amt }}</td>
                            <td>{{ $donate->payment_status }}</td>
                            <td>{{ $donate->paymentId }}</td>
                            <td>{{ $donate->updated_at }}</td>
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
