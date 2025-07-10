@extends('app')
@section('content')
<div class="container"
     style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh; margin-top: 20%">
    <form action="{{url('edit')}}" method="post">@csrf
        <div class="card" style="padding-right: 20px">
            <a class="singup textfa">ویرایش اطلاعات</a>
            <div class="inputBox1">
                <input type="text" name="name" required="required" value="{{$user->name}}"
                       style="font-family: 'Baloo Bhaijaan 2', cursive;text-align: left">
                <span class="user textfa">نام</span>
            </div>
            <div class="inputBox">
                <input type="number" name="number" required="required"  value="{{$user->number}}"
                       style="font-family: 'Baloo Bhaijaan 2', cursive;  ">
                <span class="textfa">شماره تلفن</span>
            </div>
            <div class="inputBox1">
                <input type="text" name="password"
                       style="font-family: 'Baloo Bhaijaan 2', cursive;text-align: left">
                <span class="user textfa">رمز جدید</span>
            </div>

            <button class="enter" type="submit"   style="font-family: 'Baloo Bhaijaan 2', cursive;font-weight: 700 ;font-size: 18px; "    >ویرایش</button>
        </div>
    </form>
</div>
@endsection

