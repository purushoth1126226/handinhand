@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="patientenrollment-create" name=enrollment title="{{ __('label.patientenrollment_title_index')}}" button='normal' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxenrollment" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>{{__('label.patientenrollment_sno_index')}}</th>
                    <th>{{__('label.patientenrollment_tokenid_index')}}</th>
                    <th>{{__('label.patientvitalshistory_enrollmentid_index')}}</th>
                    <th>{{__('label.patientenrollment_name_index')}}</th>
                    <th>{{__('label.patientenrollment_mobileno_index')}}</th>
                    <th>{{__('label.patientenrollment_village_index')}}</th> 
                    <th>{{__('label.patientenrollment_createdat_index')}}</th>
                    <th>{{__('label.patientenrollment_action_index')}}</th>
                    <th>TOKEN</th>
                </tr>
             </thead>
          </table>
       </div>
       <!--/Card-->
 </main>
@endsection

@section('footerSection')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxenrollment').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('enrollment.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'token_id', name: 'token_id' },
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'villagename', name: 'villagename' , orderable: false, searchable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action',  orderable: false, searchable: false },
            { data: 'token', name: 'token',  orderable: false, searchable: false },
        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>
@endsection
