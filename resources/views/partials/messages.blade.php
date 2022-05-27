<script>
    @if (Session::has('error'))
        @if (is_array(Session::get('error')))
            @foreach (Session::get('error') as $error)
              showToast('error', "", "{!! $error !!}");
            @endforeach
        @else
          showToast('error', "", "{!! Session::get('error') !!}");
        @endif
    @endif

    @if (Session::has('success'))
        @if (is_array(Session::get('success')))
            @foreach (Session::get('success') as $success)
              showToast('success', "", "{!! $success !!}");
            @endforeach
        @else
          showToast('success', "", "{!! Session::get('success') !!}");
        @endif
    @endif

    @if (Session::has('info'))
        @if (is_array(Session::get('info')))
            @foreach (Session::get('info') as $info)
              showToast('info', "", "{!! $info !!}");
            @endforeach
        @else
          showToast('info', "", "{!! Session::get('info') !!}");
        @endif
    @endif

    @if (Session::has('warning'))
        @if (is_array(Session::get('warning')))
            @foreach (Session::get('warning') as $warning)
              showToast('warning', "", "{!! $warning !!}");
            @endforeach
        @else
          showToast('warning', "", "{!! Session::get('warning') !!}");
        @endif
    @endif
</script>