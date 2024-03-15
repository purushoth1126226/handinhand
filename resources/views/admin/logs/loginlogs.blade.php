@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="test" name=setting title="{{__('label.loginlogs_title_index')}}" button='disable' gate='true' />

<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxloginlogs" class="stripe hover py-2" style="width:100%">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>{{__('label.loginlogs_id_index')}}</th>
                    <th>{{__('label.loginlogs_name_index')}}</th>
                    <th>{{__('label.loginlogs_email_index')}}</th>
                    <th>{{__('label.loginlogs_device_index')}}</th>
                    <th>{{__('label.loginlogs_browser_index')}}</th>
                    <th>{{__('label.loginlogs_platform_index')}}</th>
                    <th>{{__('label.loginlogs_serverip_index')}}</th>
                    <th>{{__('label.loginlogs_clientip_index')}}</th>
                    <th>{{__('label.loginlogs_status_index')}}</th>
                    <th>{{__('label.loginlogs_createdat_index')}}</th>
                </tr>
             </thead>
          </table>
       </div>
       <!--/Card-->
 </main>
@endsection

@section('footerSection')
<script type="text/javascript">
    $('#ajaxloginlogs').DataTable({
     responsive: true,
     processing: true,
     "order": [[ 0, "desc" ]],
     serverSide: true,
     "ajax": {
         "url": '{!! route('loginlogs') !!}',
         'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
         "type": "GET"
     },
     columns: [
        { data: 'id', name: 'id' },
         { data: 'user_name', name: 'user_name' },
         { data: 'email', name: 'email' },
         { data: 'device', name: 'device' },
         { data: 'browser', name: 'browser' },
         { data: 'platform', name: 'platform' },
         { data: 'serverIp', name: 'serverIp' },
         { data: 'clientIp', name: 'clientIp' },
         { data: 'login_status', name: 'login_status' },
         { data: 'created_at', name: 'created_at' },
     ]
    })
    .columns.adjust()
    .responsive.recalc();

 </script>
@endsection
