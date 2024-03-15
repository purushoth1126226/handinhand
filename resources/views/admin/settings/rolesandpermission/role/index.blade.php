@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="role-create" name=role title="ROLE" button='normal' gate='true' />
<main class="w-full flex-grow p-3">
       <!--Card-->
       <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
          <table id="ajaxrole" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
             <thead class="bg-blue-600 text-white">
                <tr>
                    <th>ID</th>
                    <th>ROLE</th>
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
        $('#ajaxrole').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "ajax": {
            "url": '{!! route('role.index') !!}',
            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "type": "GET"
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action',  orderable: false, searchable: false },
        ]
        })
        .columns.adjust()
        .responsive.recalc();
        });
    </script>
@endsection
