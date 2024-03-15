@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="" name=pharmacy title="{{__('label.pharmacy_title_index')}}" button='disable' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxdrug" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                   <th>{{__('label.drug_sno_index')}}</th>
                    <th>{{__('label.pharmacy_id_index')}}</th>
                    <th>{{__('label.pharmacy_drug_index')}}</th>
                    <th>{{__('label.pharmacy_genericname_index')}}</th>
                    <th>{{__('label.pharmacy_pharmacystock_index')}}</th>

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
        $('#ajaxdrug').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('pharmacystock') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
            { data: 'generic_name', name: 'generic_name' },
            { data: 'currentstock', name: 'currentstock' },

        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>
@endsection
