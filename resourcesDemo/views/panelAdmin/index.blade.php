@extends('app')
@section('content')

    <div class="container"
         style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh; ">
        <form class="form" action="{{url('make/host')}}" method="post" style="text-align: left">@csrf
            <p class="title">ایجاد جشن </p>
            <p class="message text-right">در اینجا جشن های خود را اضافه کنید وتعداد را وارد کنید </p>
            <label>
                <input required="" placeholder="" name="name" type="text" class="input">
                <span>جشن</span>
            </label>
            <label>
                <input required="" placeholder="" name="number" type="number" class="input">
                <span>موبایل</span>
            </label>
            <label>
                <input required="" placeholder="" name="from" type="number" class="input">
                <span>تعداد</span>
            </label>
            <button class="submit">ایجاد</button>
            {{--            <p class="signin">Already have an acount ? <a href="#">Signin</a> </p>--}}
        </form>

    </div>
    <div class="w-full flex justify-center">
        <div class="overflow-hidden border border-gray-300 rounded-[23px] bg-white max-w-[350px]">
            <input type="text" id="searchInput" placeholder="جستجو..." class="p-2  w-full text-right focus:outline-none focus:none" style="padding: 14px;width:350px">
            <!-- Your Table Code Here -->
            <div style="overflow-x:scroll;">
                <table class="min-w-full bg-white shadow-md rounded-lg table-auto">
                    <thead class=" text-black sticky top-0 z-10" style="background: rgba(244,244,244,0.82);border-bottom: 1px solid;border-color: #e1e1e1 ">
                    <tr>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">نام</th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">شماره</th>
                        <th class="py-3 px-6 text-center font-medium text-black uppercase tracking-wider" style="color: #2c2c2c">تعداد</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($user->Users->reverse() as $item)
                        <tr class="hover:bg-red-100 cursor-pointer" onclick="location.href='{{ url('go_down/' . $item->id) }}'">
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-right" style="color: #000000 !important;font-weight:600 " >{{$item->name}}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap text-center">{{$item->number}}</td>
                            <td class="py-4 px-6 text-sm text-gray-900 whitespace-nowrap" >{{$item->from}}</td>

                        </tr>
                        <tr class="spacer">
                        </tr>
                    @endforeach
                    <!-- پیغام تایید و دکمه‌ها -->

                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection

