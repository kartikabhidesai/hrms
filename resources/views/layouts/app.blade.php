<!DOCTYPE html>
<html>
    @include('layouts.include.header')
    <body >
    <div id="wrapper">
          @php
        if (!empty(Auth()->guard('admin')->user())) {
            $data = Auth()->guard('admin')->user();
        }
        if (!empty(Auth()->guard('client')->user())) {
            $data = Auth()->guard('client')->user();
        }
       @endphp
        @if($data['type'] = 'CLIENT')
            @include('layouts.include.leftpanel.client-left-sidebar')
        @else
            @include('layouts.include.leftpanel.admin-left-sidebar')
        @endif    
        <div id="page-wrapper" class="gray-bg">
     
            @include('layouts.include.body_header')
            @include('layouts.include.breadcrumb')
            @include('layouts.include.message')
       
            @yield('content')
            @include('layouts.include.body_footer')
        </div>
    </div>
    @include('layouts.include.footer')
</body>
</html>