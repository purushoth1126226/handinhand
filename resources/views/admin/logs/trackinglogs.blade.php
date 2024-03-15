@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="test" name=enquiry title="{{__('label.trackinglogs_title_index')}}" button='disable' gate='true' />

<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxtrackinglogs" class="stripe hover py-2" style="width:100%">
             <thead class="bg-blue-500 text-white">
                <tr>
                    <th>{{__('label.trackinglogs_id_index')}}</th>
                    <th>{{__('label.trackinglogs_name_index')}}</th>
                    <th>{{__('label.trackinglogs_details_index')}}</th>
                    <th>{{__('label.trackinglogs_createdat_index')}}</th>
                </tr>
             </thead>
          </table>
       </div>
       <!--/Card-->
 </main>
@endsection

@section('footerSection')
<script type="text/javascript">
    $('#ajaxtrackinglogs').DataTable({
     processing: true,
     responsive: true,
     "order": [[ 0, "desc" ]],
     serverSide: true,
     "ajax": {
         "url": '{!! route('trackinglogs') !!}',
         'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
         "type": "GET"
     },
     columns: [
         { data: 'id', name: 'id' },
         { data: 'name', name: 'name' },
         { data: 'details', name: 'details' },
         { data: 'created_at', name: 'created_at' },
     ]
    }).columns.adjust().responsive.recalc();
 </script>
@endsection
