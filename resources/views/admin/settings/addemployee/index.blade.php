@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="addemployee-create" name=addemployee title="{{__('label.settings_title_index')}}" button='normal' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxaddemployee" class="stripe hover py-2" style="width:100%">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>{{__('label.settings_sno_index')}}</th>
                    <th>{{__('label.settings_enrollmentid_index')}}</th>
                    <th>{{__('label.settings_name_index')}}</th>
                    <th>{{__('label.settings_mobileno_index')}}</th>
                    <th>{{__('label.settings_email_index')}}</th>
                    <th>{{__('label.settings_status_index')}}</th>
                    <th>{{__('label.settings_createdby_index')}} </th>
                    <th>{{__('label.settings_createdat_index')}}</th>
                    <th>{{__('label.settings_action_index')}}</th>
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
        $('#ajaxaddemployee').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('addemployee.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'employee_id', name: 'employee_id' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action',  orderable: false, searchable: false },
        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>
@endsection
