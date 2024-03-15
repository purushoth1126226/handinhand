@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')

<x-admin.layouts.adminindexnav can="inward-create" name=inward title="{{__('label.inward_title_create')}}" button='normal' gate='true' />

<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxinward" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                  <th>{{__('label.suppplier_id_index')}}</th>
                   <th>{{__('label.suppplier_companyname_create')}}</th>
                   <th>{{__('label.suppplier_name_create')}}</th>
                   <th>{{__('label.suppplier_contactmobno_create')}}</th>
                    <th>{{__('label.suppplier_createdby_index')}}</th>
                    <th>{{__('label.suppplier_createdat_index')}}</th>
                    <th>{{__('label.suppplier_action_index')}}</th>
                  
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
        $('#ajaxinward').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('inward.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'companyname', name: 'companyname' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'phone', name: 'phone' },

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
