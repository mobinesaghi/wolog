@extends('app')
@section('content')

    <div class="container"
         style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh;">
        <form action="{{url('make/host')}}" method="post">@csrf
            <div class="card" style="padding-right: 20px">
                <a class="singup textfa">اضافه کردن مهمان</a>
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
                <button class="enter" type="submit" style="font-weight: 590">Enter</button>
            </div>
        </form>
    </div>
    @foreach($user->Users as $item)
        <div class="container" style="min-height: 8vh; display: flex; align-items: center; justify-content: center;">
            <a>
                <button class="callbutton custom-button" style="font-family: 'Baloo Bhaijaan 2', cursive;">
                    <div>
                        <label> {{$item->name}} </label>
                        <br>
                        <label style="width: 210px !important; "> {{$item->number}} </label>
                    </div>
                </button>
            </a>
        </div>
    @endforeach

@endsection

