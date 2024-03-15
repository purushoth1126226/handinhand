@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection

@section('main-content')
<main class="w-full flex-grow p-3">
    <x-admin.layouts.adminindexnav can="ttest" name=eventcalendar title="EVENT CALENDAR" button='normal' gate='true' />
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="eventcalendar" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>CREATED BY</th>
                    <th>CREATED AT</th>
                    <th>ACTION</th>
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
        $('#eventcalendar').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('eventcalendar.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'uniqid', name: 'uniqid' },
            { data: 'title', name: 'title' },
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
