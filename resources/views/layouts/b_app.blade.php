<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <title>PITAHC Integrated Management System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- Alpine JS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    @yield('third_party_stylesheets')

    @stack('page_css')
    <livewire:styles />
</head>



<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm accent-primary">
  <div class="wrapper">
  @if( Auth::user() )
      <!-- Main Header -->
      @include('layouts.b_navbar')

      <!-- Left side column. contains the logo and sidebar -->
      @include('layouts.b_sidebar')

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">
      @yield('content')
      </div>

      <!-- Main Footer -->
      @include('layouts.b_footer')
  @else
    <div>
        @yield('content')
    </div>
  @endif
  </div>

<script src="{{ asset('js/app.js') }}" defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Tostr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>

<!-- Popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
@yield('third_party_scripts')
<script>
  $(document).ready(function() {
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    window.addEventListener('success-message', event=> {
          $('#add-ict-request-form, #start-request-form, #start-request-form, #resolve-request-form, #close-request-form, #delete-form, #cancel-ict-request-form').modal('hide');
          toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('warning-message', event=> {
          $('#add-ict-request-form, #start-request-form, #start-request-form, #resolve-request-form, #close-request-form, #delete-form, #cancel-ict-request-form').modal('hide');
          toastr.warning(event.detail.message, 'Warning!');
    })

    window.addEventListener('error-message', event=> {
          $('#add-ict-request-form, #start-request-form, #start-request-form, #resolve-request-form, #close-request-form, #delete-form, #cancel-ict-request-form').modal('hide');
          toastr.error(event.detail.message, 'Notification!');
    })
    
  });

  $(document).ready(function() {
    window.addEventListener('hide-add-ict-request-form', event=> {
      $('#add-ict-request-form').modal('hide');
    })
  });

  window.addEventListener('show-add-ict-request-form', event=> {
    $('#add-ict-request-form').modal({
        backdrop: 'static',
        keyboard: false
      });   
  });

  $(document).ready(function() {
    window.addEventListener('hide-start-request-form', event=> {
      $('#start-request-form').modal('hide');
    })
  });

  window.addEventListener('show-start-request-form', event=> {
    $('#start-request-form').modal({
        backdrop: 'static',
        keyboard: false
      });   
  });

  $(document).ready(function() {
    window.addEventListener('hide-resolve-request-form', event=> {
      $('#resolve-request-form').modal('hide');
    })
  });

  window.addEventListener('show-resolve-request-form', event=> {
    $('#resolve-request-form').modal({
        backdrop: 'static',
        keyboard: false
      });   
  });

  $(document).ready(function() {
    window.addEventListener('hide-close-request-form', event=> {
      $('#close-request-form').modal('hide');
    })
  });

  window.addEventListener('show-close-request-form', event=> {
    $('#close-request-form').modal({
        backdrop: 'static',
        keyboard: false
      });   
  });

  $(document).ready(function() {
    window.addEventListener('hide-cancel-ict-request-form', event=> {
      $('#cancel-ict-request-form').modal('hide');
    })
  });

  window.addEventListener('show-cancel-ict-request-form', event=> {
    $('#cancel-ict-request-form').modal({
        backdrop: 'static',
        keyboard: false
      });   
  });

  $(document).ready(function() {
    window.addEventListener('hide-delete-form', event=> {
      $('#delete-form').modal('hide');
    })
  });

  window.addEventListener('show-delete-form', event=> {
    $('#delete-form').modal({
        backdrop: 'static',
        keyboard: false
      });   
  });
  
  $(window).on('load', function() {
        $('#noAccessModal').modal({
        backdrop: 'static',
        keyboard: false
      });    
  }); 

  function calculatePercent(numerator, denominator, percent){
      $("#"+numerator+", #"+denominator+"").keyup(function () {
      myStr = $("#"+numerator).val();
      myStr2 = $("#"+denominator).val();
      myStr3 = (Number(myStr) / Number(myStr2))*100;
      $("#"+percent).val(myStr3.toFixed(2));
    });
  }

  function fnExcelReport(tableID)
  {
      var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
      var textRange; var j=0;
      tab = document.getElementById(tableID); // id of table

      for(j = 0 ; j < tab.rows.length ; j++) 
      {     
          tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
          //tab_text=tab_text+"</tr>";
      }

      tab_text=tab_text+"</table>";
      tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
      tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

      var ua = window.navigator.userAgent;
      var msie = ua.indexOf("MSIE "); 

      if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
      {
          txtArea1.document.open("txt/html","replace");
          txtArea1.document.write(tab_text);
          txtArea1.document.close();
          txtArea1.focus(); 
          sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
      }  
      else                 //other browser not tested on IE 11
          sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

      return (sa);
  }

  function selectElementContents(el) {
    var body = document.body,
      range, sel;
    if (document.createRange && window.getSelection) {
      range = document.createRange();
      sel = window.getSelection();
      sel.removeAllRanges();
      range.selectNodeContents(el);
      sel.addRange(range);
    }
    document.execCommand("Copy");
  }

  function download(id) {
    const imageLink = document.createElement('a')
    const canvas = document.getElementById(id);
    imageLink.download = 'canvas.png';
    imageLink.href = canvas.toDataURL('image/png', 1);
    imageLink.click();
  }

  function printDiv(el){                     
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}  
</script>
@stack('page_scripts')
<livewire:scripts />
</body>

</html>
