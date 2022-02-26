<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": 'toast-bottom-right'

    }
            toastr.success("{{ session('message') }}");
    @endif
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": 'toast-bottom-right'


    }
            toastr.success("{{ session('success') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": 'toast-bottom-right'

    }
            toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": 'toast-bottom-right'

    }
            toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": 'toast-bottom-right'

    }
            toastr.warning("{{ session('warning') }}");
    @endif

    @if(count($errors)>0)  
    @foreach ($errors->all() as $error)
    toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
            "positionClass": 'toast-bottom-right'

        }
    toastr.error("{{ $error }}");
    @endforeach
    @endif
  </script>