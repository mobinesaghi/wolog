@extends('app')
@section('content')
{{--    @php(dd($user->number))--}}
    <div class="container"
         style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh; ">
        <form class="form" action="{{ isset($User) ? url('editHim') : url('editHim') }}" method="post" style="text-align: left">@csrf
            <p class="title">فرم ویرایش </p>
            <p class="message text-right">در اینجا جشن های خود را اضافه کنید وتعداد را وارد کنید </p>
            <label>
                <input required="" placeholder="" name="name" type="text" class="input" value="@if(isset($User)){{$User->name}}@else{{$user->name}}@endif">
                <span>نام</span>
            </label>
            <label>
                <input required="" placeholder="" name="number" type="number" class="input" value="@if(isset($User)){{$User->number}}@else{{$user->number}}@endif">
                <span>موبایل</span>
            </label>
            @if(isset($User))
                @if($User->from)
                    <div  style="text-align: center">
                        <input type="checkbox" id="setAsValid" name="setAsValid" value="true">
                        <label for="setAsValid">تایید کاربر</label>
                    </div>
                @endif
            @endif
            <input  type="hidden" name="id" value="@if(isset($User)){{$User->id}}@else{{$user->id}} @endif">
            <button class="submit">ویرایش</button>
        </form>

    </div>
@endsection

