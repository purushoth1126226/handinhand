@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="ttest" name=inwarditemreport title="INWARD ITEM" button='disable' gate='true' />
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
            <button type="button" name="filter" id="filter" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">{{ __('label.patientenrollmentreport_filter_index')}}</button>
         </div>
         <div class="inline-block mr-2 mt-2">
            <a href=""  id="inwarditemreportcsv" target="_blank" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">{{ __('label.patientenrollmentreport_csv_index')}}</a>
         </div>
           <div class="inline-block mr-2 mt-2">
              <button type="button" name="refresh" id="refresh" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">{{ __('label.patientenrollmentreport_refresh_index')}}</button>
           </div>

   </div>
       </center>

       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxinwarditem" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>S.NO</th>
                    <th>NAME</th>
                    <th>QTY</th>
                    <th>UNIT</th>
                    <th>BALANCE</th>
                    <th>VARAIANT</th>
                    <th>BATCH ID</th>
                    <th>EXPIRY DATE</th>
                    <th>EXPIRY ALERT</th>
                    <th>MANUFACTURE DATE</th>

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

        $('#ajaxinwarditem').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('report.ajaxinwarditemreport') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data:{from_date:from_date, to_date:to_date},
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'drug_name', name: 'drug_name' },
            { data: 'qty', name: 'qty' },
            { data: 'unit', name: 'unit' },
            { data: 'balance', name: 'balance' },
            { data: 'variant', name: 'variant' },
            { data: 'bacth_id', name: 'bacth_id' },
            { data: 'expiry_date', name: 'expiry_date' },
            { data: 'expiry_alertdate', name: 'expiry_alertdate' },
            { data: 'manufacture_date', name: 'manufacture_date' },

        ]
        })


    }

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            $('#ajaxinwarditem').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });


    $('#inwarditemreportcsv').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            var url = 'inwarditemreportcsv/'+from_date+'/'+to_date;
            $("#inwarditemreportcsv").attr("href", url)
            $('#ajaxinwarditem').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });


    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#ajaxinwarditem').DataTable().destroy();
        load_data();
    });

});
</script>



@endsection
