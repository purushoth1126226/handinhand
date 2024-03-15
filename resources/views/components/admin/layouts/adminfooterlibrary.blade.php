{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}


{!! Html::script('/js/alpine.min.js'); !!}
{!! Html::script('/js/font-awesome.js'); !!}
{!! Html::script('/js/jquery-3.4.1.min.js'); !!}
{!! Html::script('/js/jquery.dataTables.min.js'); !!}
{!! Html::script('/js/dataTables.responsive.min.js'); !!}


<script>

  var basepath = {!! json_encode(Request::path()) !!}
  var split = basepath.split('/');
  var classname = split[1]+'active';
  $('.sidenavbar').removeClass("bg-blue-500 text-white");
  $('.' + classname).addClass("bg-blue-500 text-white");

  function setup() {
    return {
      isSidebarOpen: {!! json_encode(session()->get('sidenavstatus')) !!},
      toggleSidebar() {
        fetch(`sidenavupdates`)
          .then(res => res.json())
          .then(data => {
  
          });
        this.isSidebarOpen = !this.isSidebarOpen
      },
      isSettingsPanelOpen: false,
      toggleSettingsPanel() {
        this.isSettingsPanelOpen = !this.isSettingsPanelOpen
      },
    }
  }
 </script>

<style type="text/css">
  .fa-spin {
       display: none;
  }
</style>
<script type="text/javascript">
    (function () {
        $('.form_prevent_multiple_submits').on('submit', function(){
          $('.button_prevent_multiple_submits').attr('disabled', 'true');
          $('.fa-spin').show();
        })
    })();
</script>



@section('footerSection')
@show
