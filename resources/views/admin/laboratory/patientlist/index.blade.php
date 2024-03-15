@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="labortory-create" name=labpatientlist title="{{__('label.patientlab_title_index')}}" button='disable' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxvital" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>{{__('label.patientlab_sno_index')}}</th>
                    <th>{{__('label.patientlab_enrollmentid_index')}}</th>
                    <th>{{__('label.patientlab_name_index')}}</th>
                    <th>{{__('label.patientlab_mobileno_index')}}</th>
                    <th>{{__('label.patientvisit_diagnosis_show')}} </th>
                    <th>{{__('label.patientvisit_labinvestigation_labshow')}} </th>
                    <th>{{__('label.patientlab_createdat_index')}}</th>
                    <th>{{__('label.patientlab_action_index')}}</th>
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
        $('#ajaxvital').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('labpatientlist.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [

            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'diagnosis', name: 'diagnosis' ,orderable: false, searchable: false},
            { data: 'labreport', name: 'labreport' ,orderable: false, searchable: false},
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action',  orderable: false, searchable: false },
        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>
@endsection
