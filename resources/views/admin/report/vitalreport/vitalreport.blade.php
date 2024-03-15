@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="ttest" name=vitalreport title="{{ __('label.patientenrollmentreport_title_index')}}" button='disable' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->

       <center>
       <div class="w-full py-3">
           <div class="inline-block mr-2 mt-2">
            <input type="date" name="from_date" id="from_date" class="form-input rounded block w-full p-2 focus:bg-white" placeholder="From Date" />
           </div>
           <div class="inline-block mr-2 mt-2">
            <input type="date" name="to_date" id="to_date" class="form-input rounded block w-full p-2 focus:bg-white" placeholder="To Date" />
           </div>

           <div class="inline-block mr-2 mt-2">
            <button type="button" name="filter" id="filter" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">{{ __('label.patientvitalreport_filter_index')}}</button>
         </div>
         <div class="inline-block mr-2 mt-2">
            <a href=""  id="vitalreportcsv" target="_blank" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">{{ __('label.patientvitalreport_csv_index')}}</a>
         </div>
           <div class="inline-block mr-2 mt-2">
              <button type="button" name="refresh" id="refresh" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">{{ __('label.patientvitalreport_refresh_index')}}</button>
           </div>

   </div>
       </center>

       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxvital" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>{{ __('label.patientvitalreport_sno_index')}}</th>
                    <th>{{ __('label.patientvitalreport_enrollmentid_index')}}</th>
                    <th>{{ __('label.patientvitalreport_name_index')}}</th>
                    <th>{{ __('label.patientvitalreport_mobileno_index')}}</th>
                    <th>{{ __('label.patientvitalreport_createdat_index')}}</th>
                    <th>{{ __('label.patientvitalreport_action_index')}}</th>
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


    load_data();


    function load_data(from_date = '', to_date = '') {

        $('#ajaxvital').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('report.ajaxvitalreport') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data:{from_date:from_date, to_date:to_date},
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action',  orderable: false, searchable: false },
        ]
        })


    }

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            $('#ajaxvital').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });


    $('#vitalreportcsv').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            var url = 'vitalreportcsv/'+from_date+'/'+to_date;
            $("#vitalreportcsv").attr("href", url)
            $('#ajaxvital').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });


    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#ajaxvital').DataTable().destroy();
        load_data();
    });

});
</script>



@endsection
