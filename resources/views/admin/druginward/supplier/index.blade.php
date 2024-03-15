@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can='supplier-create' name=supplier title="{{__('label.suppplier_title_index')}}" button='normal' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxsupplier" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>{{__('label.suppplier_id_index')}}</th>
                    <th>{{__('label.suppplier_title_index')}}</th>
                    <th>{{__('label.suppplier_companyname_create')}}</th>
                    <th>{{__('label.suppplier_contactmobno_create')}}</th>
                    <th>{{__('label.suppplier_email_create')}}</th>
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
        $('#ajaxsupplier').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('supplier.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
              { data: 'company', name: 'company' },
             { data: 'phone', name: 'phone' },
              { data: 'email', name: 'email' },

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
