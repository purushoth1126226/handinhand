@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="physicalandgeneralexam-create" name=physicalandgeneralexamination title="{{__('label.physicalandgeneralexamination_title_index')}}" button='normal' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxphysicalandgeneralexamination" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                   <th>{{__('label.physicalandgeneralexamination_sno_index')}}</th>
                    <th>{{__('label.physicalandgeneralexamination_id_index')}}</th>
                    <th>{{__('label.physicalandgeneralexamination_name_index')}}</th>
                    <th>{{__('label.physicalandgeneralexamination_createdby_index')}}</th>
                    <th>{{__('label.physicalandgeneralexamination_createdat_index')}}</th>
                    <th>{{__('label.physicalandgeneralexamination_action_index')}}</th>
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
        $('#ajaxphysicalandgeneralexamination').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('physicalandgeneralexamination.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
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
