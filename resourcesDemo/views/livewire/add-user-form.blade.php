<div>
    @if($success != "false")
    <h2 style="color: green">
        کاربر
        {{$success}}
        زخیره شد.
        🎉🎉
    </h2>

    @endif
    <form method="post" wire:submit="save" {{--action="saveuser"--}}>
        @csrf
        <div class="form-group">
            <label>کد ملی</label>
            <input wire:model="name" name="name" class="form-control" type="number" placeholder="لطفا فرم را پر کنید" required>
            <hr>
            <label> حقوق/شهریه (تومان)</label>
            <input wire:model="payment" name="payment" class="form-control" type="number" placeholder="لطفا فرم را پر کنید">
            <hr>
            <label>نام و نام خانوادگی</label>
            <input wire:model="student" name="student" class="form-control" type="text" placeholder="لطفا فرم را پر کنید">
            <hr>

            <label>شماره تماس</label>
            <input wire:model="phone" name="phone" class="form-control" type="number" placeholder="لطفا فرم را پر کنید">
            <hr>
            <label>رمز ورود</label>
            <input wire:model="password" name="password" class="form-control" type="text" placeholder="لطفا فرم را پر کنید">
            <hr>
            <select wire:model="classid" name="classid[]" multiple>
                @foreach($classes as $class )
                    <option value="{{$class->id}}">{{$class->name}}</option>
                @endforeach

            </select>

            <button>save</button>


        </div>
    </form>

</div>
