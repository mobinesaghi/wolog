<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{url('/src/tailwindcss.js')}}"></script>
    <title>سامانه حضور و غیاب</title>
    <link rel="manifest" href="manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@600&display=swap" rel="stylesheet">

    <style>
        /* Ignore CSS variable inspection */
        :root {
            /* @phpstorm-ignore */
            --primary-color: #16c8ce;
            --text-color: #ffffff;

        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
        }

        .title {
            padding-right: 28px;
            font-size: 28px;
            color: #424e54;
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
            background-color: #16c8ce;
        }

        .title::before {
            width: 18px;
            height: 18px;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .message, .signin {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
        }

        .signin {
            text-align: center;
        }

        .signin a {
            color: royalblue;
        }

        .signin a:hover {
            text-decoration: underline royalblue;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            width: 100%;
            padding: 10px 10px 14px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input + span {
            position: absolute;
            right: 10px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown + span {
            top: 15px;
            font-size: 0.9em;
        }

        .form label .input:focus + span, .form label .input:valid + span {
            left: 10px;
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .form label .input:valid + span {
            color: green;
        }

        .submit {
            border: none;
            outline: none;
            background-color: #16c8ce;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
        }

        .submit:hover {
            background-color: rgb(255, 0, 0);
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }
            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }

        @font-face {
            font-family: 'MyCustomFont';
            src: url('{{url('/src/fonts/woff/iranyekanwebregularfanum.woff')}}') format('woff2'), url('{{url('/src/fonts/woff/iranyekanwebregularfanum.woff')}}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        * {
            font-family: "MyCustomFont", cursive;
            letter-spacing: 0 !important;
        }

        body {
            background-color: #e1e1e1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }


        .header {
            max-width: 420px;
            width: 100%;
        }
    </style>
    @yield('style')
</head>
<body>
@if (session('message'))
    <div id="error-box"
         class="bg-red-500 text-white p-4 rounded shadow-md fixed top-5 left-1/2 transform -translate-x-1/2 transition-opacity duration-1000 ease-in-out opacity-100"
         style="z-index: 100; background:{{ session('message.color') }};width: 80%;">
        {{ session('message.text') }}
    </div>
@endif



<div style="max-width: 420px; width: 100%;">
    <div class="header"
         style="position: fixed;padding: 6px; top: 0;max-width: 420px; width: 100%;  z-index: 11; background-color: #16c8ce;font-size: 24px;font-weight: 600; color: #FFFFFF">
        <div style="padding: 5px 30px 5px 30px; display: flex;justify-content:center">
            <div class="headerItems">
                <label>wolog</label>
{{--                <label>{{$user->name}}</label>--}}
{{--                @if(isset($_COOKIE['token_0']) || isset($_COOKIE['token_1']) || isset($_COOKIE['token_2']))--}}
{{--                    <label style="font-size: 12px">({{ $user->type == 0 ? 'ادمین' : ($user->type == 1 ? 'میزبان'  :($user->type == 2 ? 'دعوت کننده'  : 'مهمان')) }}--}}
{{--                        )</label>--}}
{{--                @endif--}}

            </div>

        </div>
    </div>
    <div style="margin-bottom: 48px;"></div>

    @if(isset($attendance_recorder) and $attendance_recorder==1 or true)
        
    @else
        <div class="fixed bottom-0 max-w-[420px] w-full z-20">
            <form id="actionForm" method="POST" class="flex justify-around gap-4 items-center px-4 py-1 bg-[#16c8ce] text-[25px]" style="padding: 15px 0 10px 0">
                @csrf
                @if(isset($_COOKIE['token_0']) || isset($_COOKIE['token_1']) || isset($_COOKIE['token_2']))
                    <button type="button" onclick="submitForm('up')"><i class="fa-solid fa-arrow-up text-white"></i></button>
                @endif
                <button type="button" onclick="submitForm('logout')"><i class="fa-solid fa-right-from-bracket text-white"></i></button>
                <button type="button" onclick="submitForm('', 'GET')"><i class="fa-solid fa-house text-white"></i></button>

                <button type="button" onclick="submitForm('edit')"><i class="fa-solid fa-user text-white"></i></button>
            </form>
        </div>
    @endif

    <script>
        function submitForm(action, method = 'POST') {
            const form = document.getElementById('actionForm');
            form.action = `{{ url('/') }}/${action}`;
            form.method = method; // Sets method dynamically
            if (method === 'GET') {
                window.location.href = form.action; // Redirect for GET request
            } else {
                form.submit(); // Submit for POST request
            }
        }
    </script>


@yield('content')
<div style="margin-top: 88px;"></div>
<script>
    function openModal(title, id) {
        // Set the modal content
        const modalTitle = document.getElementById('modal-title')
        const modalBody = document.getElementById('modal-body')
        modalTitle.innerText = title

        // Set the correct link for Panel Access based on the item's ID
        const panelLink = document.getElementById('panel-access-link')
        panelLink.href = `/go_down/${id}`

        // Show the modal
        document.getElementById('modal-container').classList.remove('hidden')
    }

    // Close modal function
    function closeModal() {
        document.getElementById('modal-container').classList.add('hidden')
    }

    // Close modal when clicking outside the modal content
    document.getElementById('modal-container').addEventListener('click', (e) => {
        if (e.target === document.getElementById('modal-container')) {
            closeModal()
        }
    })
    document.addEventListener('DOMContentLoaded', function () {
        const errorBox = document.getElementById('error-box')
        if (errorBox) {
            // Fade out the error box after 3 seconds
            setTimeout(() => {
                errorBox.classList.add('opacity-0')  // Add fade-out class
                // Remove the error box after the fade-out transition ends
                errorBox.addEventListener('transitionend', () => {
                    errorBox.remove()
                })
            }, 3000)  // Duration before starting fade out
        }
    })
</script>
@yield('script')

</div>

</body>
</html>






