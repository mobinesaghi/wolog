<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{url('/src/tailwindcss.js')}}"></script>
    <title>جشن</title>
    <link rel="manifest" href="telephone/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@600&display=swap" rel="stylesheet">

    <style>

        .form { display: flex; flex-direction: column; gap: 10px; max-width: 350px; background-color: #fff; padding: 20px; border-radius: 20px; position: relative; }
        .title {
            padding-right: 28px;
            font-size: 28px;
            color: #EB192B;
            font-weight: 600;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            padding-left: 30px;
            position: relative;
        }

        .title::before, .title::after {
            content: "";
            position: absolute;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            right: 0;
            background-color: #EB192B;
        }        .title::before { width: 18px; height: 18px; }
        .title::after { width: 18px; height: 18px; animation: pulse 1s linear infinite; }
        .message, .signin { color: rgba(88, 87, 87, 0.822); font-size: 14px; }
        .signin { text-align: center; }
        .signin a { color: #EB192B; }
        .signin a:hover { text-decoration: underline #EB192B; }
        .flex { display: flex; width: 100%; gap: 6px; }
        .form label { position: relative; }
        .form label .input { width: 100%; padding: 10px 10px 20px 10px; outline: 0; border: 1px solid rgba(105, 105, 105, 0.397); border-radius: 10px; }
        .form label .input + span { position: absolute; right: 10px; top: 15px; color: grey; font-size: 0.9em; cursor: text; transition: 0.3s ease; }
        .form label .input:placeholder-shown + span { top: 15px; font-size: 0.9em; }
        .form label .input:focus + span, .form label .input:valid + span { left: 10px; top: 30px; font-size: 0.7em; font-weight: 600; }
        .form label .input:valid + span { color: green; }
        .submit { border: none; outline: none; background-color: #EB192B; padding: 10px; border-radius: 10px; color: #fff; font-size: 16px; transform: .3s ease; }
        .submit:hover { background-color: rgb(194, 56, 56); }
        @keyframes pulse { from { transform: scale(0.9); opacity: 1; } to { transform: scale(1.8); opacity: 0; } }
        @font-face { font-family: 'MyCustomFont'; src: url('{{url('/src/fonts/woff/iranyekanwebregularfanum.woff')}}') format('woff2'), url('{{url('/src/fonts/woff/iranyekanwebregularfanum.woff')}}') format('woff'); font-weight: normal; font-style: normal; }
        * { font-family: "MyCustomFont", cursive; letter-spacing: 0 !important; }
        body { background-color: #cccccc; display: flex; justify-content: center; align-items: center; margin: 0; }
        .container { max-width: 420px; width: 100%; }
        .header { max-width: 420px; width: 100%; }
    </style>
</head>
<body >
@if (session('error'))
    <div id="error-box" class="bg-red-500 text-white p-4 rounded shadow-md fixed top-5 left-1/2 transform -translate-x-1/2 transition-opacity duration-1000 ease-in-out opacity-100" style="z-index: 100;">
        {{ session('error') }}
    </div>
@endif



    <div class="container" style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh;margin-top: 10%">
        <form class="form" action="{{url('login')}}" method="post" style="text-align: left">@csrf
            <img style="margin-right: 33%" height="95"width="95" src="{{url('/Untitled-3.png')}}">
            <p class="title text-center">ورود </p>
            <p class="message text-right">سلام درصورتی که رمز برای شما پیامک نشده به ادمین خبر بدین</p>
            <label>
                <input required="" placeholder="" name="name" type="text" class="input" @if(isset($_GET['username'])) value="{{$_GET['username']}}" @endif>
                <span>موبایل</span>
            </label>
            <label>
                <input required="" placeholder="" name="password" type="password" class="input"  @if(isset($_GET['password'])) value="{{$_GET['password']}}" @endif>
                <span>رمز</span>
            </label>

            <button class="submit" style="padding: 14px" >ورود</button>
        </form>

    </div>


<div style="margin-top: 100px;"></div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const errorBox = document.getElementById('error-box');
    if (errorBox) {
      // Fade out the error box after 3 seconds
      setTimeout(() => {
        errorBox.classList.add('opacity-0');  // Add fade-out class
        // Remove the error box after the fade-out transition ends
        errorBox.addEventListener('transitionend', () => {
          errorBox.remove();
        });
      }, 3000);  // Duration before starting fade out
    }
  });
</script>


</div>

</body>
</html>





