<!DOCTYPE html>
<html>
    @include('layouts.include.header')
    <body >
    <div id="wrapper">
          @php
        if (!empty(Auth()->guard('admin')->user())) {
            $data = Auth()->guard('admin')->user();
        }
        if (!empty(Auth()->guard('employee')->user())) {
            $data = Auth()->guard('employee')->user();
        }
        if (!empty(Auth()->guard('company')->user())) {
            $data = Auth()->guard('company')->user();
        }
        @endphp
        @if($data['type'] == 'ADMIN')
            @include('layouts.include.leftpanel.admin-left-sidebar')
        @elseif($data['type'] == 'EMPLOYEE')
            @include('layouts.include.leftpanel.employee-left-sidebar')
        @else
            @include('layouts.include.leftpanel.company-left-sidebar')
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