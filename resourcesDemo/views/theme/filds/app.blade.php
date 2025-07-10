<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://jashn.alimontazer.ir//src/tailwindcss.js"></script>
    <title>Document</title>
    <link rel="manifest" href="telephone/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@600&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'MyCustomFont';
            src: url('https://jashn.alimontazer.ir/src/fonts/woff/iranyekanwebregularfanum.woff') format('woff2'),
            url('https://jashn.alimontazer.ir/src/fonts/woff/iranyekanwebregularfanum.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        .singup {
            color: #000;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            font-weight: bold;
            font-size: x-large;
            margin-top: 1.5em;
        }

        .card {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 350px;
            width: 300px;
            flex-direction: column;
            gap: 35px;
            border-radius: 15px;
            background: #e3e3e3;
            box-shadow: 16px 16px 32px #c8c8c8,
            -16px -16px 32px #fefefe;
            border-radius: 8px;
        }

        .inputBox,
        .inputBox1 {
            position: relative;
            width: 250px;
        }

        .inputBox input,
        .inputBox1 input {
            width: 100%;
            padding: 10px;
            outline: none;
            border: none;
            color: #000;
            font-size: 1em;
            background: transparent;
            border-left: 2px solid #000;
            border-bottom: 2px solid #000;
            transition: 0.1s;
            border-bottom-left-radius: 8px;
        }

        .inputBox span,
        .inputBox1 span {
            margin-top: 5px;
            position: absolute;
            top: 0;
            left: 0;
            transform: translateY(-4px);
            margin-left: 10px;
            padding: 10px;
            pointer-events: none;
            font-size: 12px;
            color: #000;
            text-transform: uppercase;
            transition: 0.5s;
            letter-spacing: 3px;
            border-radius: 8px;

        }

        .inputBox input:valid ~ span,
        .inputBox input:focus ~ span {
            transform: translateX(153px) translateY(-22px);
            font-size: 0.8em;
            padding: 5px 10px;
            background: #000;
            letter-spacing: 0.2em;
            color: #fff;
            border: 2px;
        }

        .inputBox1 input:valid ~ span,
        .inputBox1 input:focus ~ span {
            transform: translateX(196px) translateY(-22px);
            font-size: 0.8em;
            padding: 5px 10px;
            background: #000;
            letter-spacing: 0.2em;
            color: #fff;
            border: 2px;
        }

        .inputBox input:valid,
        .inputBox input:focus,
        .inputBox1 input:valid,
        .inputBox1 input:focus {
            border: 2px solid #000;
            border-radius: 8px;
        }

        .enter {
            height: 45px;
            width: 100px;
            border-radius: 5px;
            border: 2px solid #000;
            cursor: pointer;
            background-color: transparent;
            transition: 0.5s;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 3em;
        }

        .enter:hover {
            background-color: rgb(0, 0, 0);
            color: white;
        }

        .textfa {
            font-family: 'MyCustomFont', sans-serif;
            font-weight: 500;
            letter-spacing: 0 !important;
        }

        .callbutton {
            width: 9em;
            height: 3em;
            border-radius: 30em;
            font-size: 15px;
            font-family: inherit;
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            min-width: 300px;
            background-color: #e3e3e3;
            box-shadow: 6px 6px 12px #c5c5c5,
            -6px -6px 12px #ffffff;
        }

        .callbutton::before {
            content: '';
            width: 0;
            height: 3em;
            border-radius: 30em;
            position: absolute;
            top: 0;
            left: 0;
            background-image: linear-gradient(to right, #0fd850 0%, #f9f047 100%);
            transition: .5s ease;
            display: block;
            z-index: -1;
        }

        .callbutton:hover::before {
            width: 300px;

        }

        .col {
            width: 33%;
            text-align: center;
        }
    </style>
    @yield('style')
</head>
<body style="background-color: #e8e8e8">
<div style="position: fixed; bottom: 0; align-items: center; width: 100%; margin: 20px; max-width: 90%; z-index: 11;">
    <div class="flex justify-around gap-4 items-center px-4 py-1 bg-black rounded-[15px] ring-1 ring-white" style="z-index: 11">

        <div
                class="relative group hover:cursor-pointer hover:bg-slate-800 p-2 rounded-full transition-all duration-500"style="z-index: 10"
        >
            <svg
                    width="20"
                    height="20"
                    viewBox="0 0 30 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M15.0013 0C10.482 0 6.81914 3.50348 6.81914 7.82609V9.13044C6.81914 13.453 10.482 16.9565 15.0013 16.9565C19.5206 16.9565 23.1835 13.453 23.1835 9.13044V7.82609C23.1835 3.50348 19.5206 0 15.0013 0ZM14.9987 20.8696C9.53569 20.8696 2.52628 23.6959 0.509366 26.2041C-0.737054 27.755 0.44947 30 2.49366 30H27.5063C29.5505 30 30.7371 27.755 29.4906 26.2041C27.4737 23.6972 20.4616 20.8696 14.9987 20.8696Z"
                        fill="white"
                ></path>
            </svg>
            <a href="{{url("edit")}}">
                <div
                        class="textfa absolute bottom-full left-1/2 transform -translate-x-1/2 mb-4 w-max px-2 py-1 text-white bg-black rounded-md opacity-0 scale-50 transition-all duration-500 group-hover:opacity-100 group-hover:scale-100"
                        style="color: #0fd850"
                >
                    ویرایش اطلاعات کاربری
                </div>
            </a>

        </div>
        <a href="{{url("")}}">
        <div class="relative group hover:cursor-pointer hover:bg-slate-800 p-2 rounded-full transition-all duration-500"style="z-index: 10">
            <svg
                    width="20"
                    height="20"
                    viewBox="0 0 30 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M27.9167 30H20.4167C19.2658 30 18.3333 29.1392 18.3333 28.0769V21.1538C18.3333 20.3038 17.5875 19.6154 16.6667 19.6154H13.3333C12.4125 19.6154 11.6667 20.3038 11.6667 21.1538V28.0769C11.6667 29.1392 10.7342 30 9.58333 30H2.08333C0.9325 30 0 29.1392 0 28.0769V13.3946C0 11.6262 0.878334 9.95539 2.3825 8.86154L14.2258 0.246923C14.68 -0.0823077 15.32 -0.0823077 15.7733 0.246923L27.6183 8.86154C29.1225 9.95539 30 11.6254 30 13.3931V28.0769C30 29.1392 29.0675 30 27.9167 30Z"
                        fill="white"
                ></path>
            </svg>

            <div
                    class="textfa absolute bottom-full left-1/2 transform -translate-x-1/2 mb-4 w-max px-2 py-1 text-white bg-black rounded-md opacity-0 scale-50 transition-all duration-500 group-hover:opacity-100 group-hover:scale-100"
            >
                خانه
            </div>
        </div>
        </a>


        <div class="relative group hover:cursor-pointer hover:bg-slate-800 p-2 rounded-full transition-all duration-500" style="z-index: 10">
            <svg width="35" height="35" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                      stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                />

            </svg>
            <a href="{{url("logout")}}">
                <div style="color: #ff4949"
                     class="textfa absolute bottom-full left-1/2 -translate-x-1/2 mb-4 w-max px-2 py-1 text-white bg-black rounded-md opacity-0 transform scale-50 transition-all duration-500 group-hover:opacity-100 group-hover:scale-100">
                    تایید خروج
                </div>

            </a>
        </div>
        <a href="{{url("up")}}">
        <div class="relative group hover:cursor-pointer hover:bg-slate-800 p-2 rounded-full transition-all duration-500" style="z-index: 10">
            <svg width="35" height="35" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                      stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                />
            </svg>
                <div style="color: #0060ff"
                     class="textfa absolute bottom-full left-1/2 -translate-x-1/2 mb-4 w-max px-2 py-1 text-white bg-black rounded-md opacity-0 transform scale-50 transition-all duration-500 group-hover:opacity-100 group-hover:scale-100">
                    پنل بالایی
                </div>


        </div>
        </a>
    </div>
</div>


@yield('content')
<div style="margin-top: 100px;"></div>
@yield('script')
</body>
</html>






