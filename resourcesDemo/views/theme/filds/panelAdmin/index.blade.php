@extends('app')
@section('content')

    <div class="container"
         style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh;">
        <form action="{{url('make/host')}}" method="post">@csrf
            <div class="card" style="padding-right: 20px">
                <a class="singup textfa">اضافه کردن جشن</a>
                <div class="inputBox1">
                    <input type="text" name="name" required="required"
                           style="font-family: 'Baloo Bhaijaan 2', cursive;text-align: left">
                    <span class="user textfa">نام</span>
                </div>
                <div class="inputBox">
                    <input type="number" name="number" required="required"
                           style="font-family: 'Baloo Bhaijaan 2', cursive;  ">
                    <span class="textfa">شماره تلفن</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="from" required="required"
                           style="font-family: 'Baloo Bhaijaan 2', cursive;text-align: left">
                    <span class="user textfa">تعداد</span>
                </div>
                <button class="enter" type="submit" style="font-weight: 590">Enter</button>
            </div>
        </form>
    </div>
    @foreach($user->Users->reverse() as $item)
        <div class="container" style="min-height: 8vh; display: flex; align-items: center; justify-content: center;">
            <a href="{{url("go_down/$item->id")}}">
                <button class="callbutton custom-button" style="font-family: 'Baloo Bhaijaan 2', cursive;">
                    <div>
                        <label> {{$item->name}} </label>
                    </div>
                    <div style="display: flex">
                        <label style="background: black; color: #FFFFFF;border-radius: 6px;padding: 20px 5px 20px 5px; margin-top: -30px">{{$item->from}}</label> <!-- مقدار رنج -->
                        <label style="width: 210px !important; "> {{$item->number}} </label>
                    </div>
                </button>
            </a>
        </div>
    @endforeach

@endsection

