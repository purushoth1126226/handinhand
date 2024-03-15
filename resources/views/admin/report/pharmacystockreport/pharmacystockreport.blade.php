@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="ttest" name=pharmacystockreport title="PHARMACY STOCK" button='disable' gate='true' />
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
            <a href=""  id="pharmacystockreportcsv" target="_blank" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">{{ __('label.patientenrollmentreport_csv_index')}}</a>
         </div>
           <div class="inline-block mr-2 mt-2">
              <button type="button" name="refresh" id="refresh" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-yellow-500 hover:bg-yellow-600 hover:shadow-lg">{{ __('label.patientenrollmentreport_refresh_index')}}</button>
           </div>

   </div>
       </center>

       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxpharmacystock" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
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


    load_data();


    function load_data(from_date = '', to_date = '') {

        $('#ajaxpharmacystock').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('report.ajaxpharmacystockreport') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data:{from_date:from_date, to_date:to_date},
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable: false, searchable: false},
            { data: 'uniqid', name: 'uniqid' },
            { data: 'name', name: 'name' },
            { data: 'generic_name', name: 'generic_name' },
            { data: 'currentstock', name: 'currentstock' },



        ]
        })


    }

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            $('#ajaxpharmacystock').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });


    $('#pharmacystockreportcsv').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '') {
            var url = 'pharmacystockreportcsv/'+from_date+'/'+to_date;
            $("#pharmacystockreportcsv").attr("href", url)
            $('#ajaxpharmacystock').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });


    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#ajaxpharmacystock').DataTable().destroy();
        load_data();
    });

});
</script>



@endsection
