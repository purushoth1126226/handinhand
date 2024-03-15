@extends('components.admin.layouts.adminapp')
@section('headSection')
{{ Html::style( asset('/css/select2.min.css')) }}
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav  name=patientlist title="{{__('label.patientdoctor_title_index')}}" :obj="$vital" backbutton="enable" />

<main class="w-full flex-grow px-6 py-2">
    <!--Card-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       {!! Form::model($vital, ['route' => ['doctor.store', $vital->id],  'id' => '', 'class' => ' form_prevent_multiple_submits ', 'novalidate' => 'novalidate', 'files' => 'true','enctype'=>'multipart/form-data']) !!}
       {{ Form::hidden('id', $vital->id, array('id' => 'invisible_id')) }}
       {{ Form::hidden('uuid', $vital->uuid, array('id' => 'uuid')) }}
       {{ Form::hidden('uniqid', $vital->uniqid, array('id' => 'uniqid')) }}

       {{ Form::hidden('enrollment_id', $vital->enrollment_id, array('id' => 'enrollment_idval')) }}
       {{ Form::hidden('enrollment_uuid', $vital->enrollment_uuid, array('id' => 'enrollment_uuidval')) }}
       {{ Form::hidden('enrollment_uniqid', $vital->enrollment_uniqid, array('id' => 'enrollment_uniqidval')) }}

        @include('admin.doctor.todaypatientlist.form')

        <div class="md:flex md:items-center justify-center">
         @if ($vital->id)
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.patientdoctor_create_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @else
         {!! Form::button( '<i class="fa fa-spinner m-1 fa-spin"></i>'.__('label.patientdoctor_create_edit'), ['type' => 'submit', 'class' => 'shadow bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 m-1 flex rounded button_prevent_multiple_submits'] ) !!}
         @endif
         <a href="" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">{{__('label.patientdoctor_cancel_edit')}}</a>
       </div>

       {!! Form::close() !!}
    </div>
 </main>

@endsection

@section('footerSection')

 {!! Html::script('/js/vue.js'); !!}
{!! Html::script('/js/select2.min.js'); !!}
{!! Html::script('/js/vue-simple-search-dropdown.min.js'); !!}
{!! Html::script('/js/vue-resource.min.js'); !!}

{{-- <script type="text/javascript" src="https://unpkg.com/vue-simple-search-dropdown@latest/dist/vue-simple-search-dropdown.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js'></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script> --}}
{{--<script type="text/javascript" src="https://unpkg.com/vue-simple-search-dropdown@latest/dist/vue-simple-search-dropdown.min.js"></script>
{{--  Need to remove later --}}


{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple_one').select2();

        ajaxvitalsmultiselectdoctor();

        function ajaxvitalsmultiselectdoctor() {
            $.ajax({
                url: "{{route('ajaxvitalsmultiselectdoctor')}}",
                mehtod: "get",
                dataType: 'json',
                success: function(data) {
                 $('#physicalandgeneralexaminationoption').html(data.physicalandgeneralexaminationoption);
                 $('#physicalandgeneralexaminationoption').val({!! $vital->physicalandgeneralexaminationSelect !!});
                 $('#physicalandgeneralexaminationoption').trigger('change');

                 $('#diagnosisoption').html(data.diagnosisoption);
                 $('#diagnosisoption').val({!! $vital->diagnosisSelect !!});
                 $('#diagnosisoption').trigger('change');

                 $('#labinvestigationoption').html(data.labinvestigationoption);
                 $('#labinvestigationoption').val({!! $vital->labinvestigationSelect !!});
                 $('#labinvestigationoption').trigger('change');
                }
            })
        }
    });
     </script>


<script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';
    var status = {!! json_encode($status) !!};
    if (status == 0) {
        window._form = {
            drug: [{
                drug: '',
                morning: false,
                afternoon: false,
                evening: false,
                night: false,
                bf: false,
                af: false,
                count: 0,
                doctordrug: 0,
                },
            ]
        };
    } else {
        window._form = {
            drug: {!! $doctorprescription->toJson() !!},
        };

    }
    </script>
    <script src="{{ asset('/js/doctordrug.js') }}"></script>

@endsection
