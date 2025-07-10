{{--<pre>--}}
{{--    <?php--}}
{{--    print_r($user);--}}
{{--    dd($user->telephonnote);--}}


{{--    ?>--}}
{{--</pre>--}}



        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="manifest" href="telephone/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@600&display=swap" rel="stylesheet">
    <style>
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

        .inputBox input:valid~span,
        .inputBox input:focus~span {
            transform: translateX(153px) translateY(-22px);
            font-size: 0.8em;
            padding: 5px 10px;
            background: #000;
            letter-spacing: 0.2em;
            color: #fff;
            border: 2px;
        }

        .inputBox1 input:valid~span,
        .inputBox1 input:focus~span {
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
        .textfa{
            font-family: 'Baloo Bhaijaan 2', cursive;
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
    </style>
</head>
<body style="background-color: #e8e8e8">
{{--<header>--}}

{{--        <form action="">--}}
{{--            <input class="callbutton" name="q" style="font-family: 'Baloo Bhaijaan 2', cursive;padding: 5px 20px;">--}}
{{--            <input class="callbutton" type="submit" value="جستجو" style="font-family: 'Baloo Bhaijaan 2', cursive;padding: 5px 20px;">--}}


{{--        </form>--}}


{{--</header>--}}



<div class="container" style="letter-spacing: 0;display: flex;justify-content: center;align-items: center;min-height: 60vh;">
    <form action="telephonnotesave" method="post">@csrf
        <div class="card" style="padding-right: 20px">
            <a class="singup textfa">اضافه کردن شماره</a>
            <div class="inputBox1">
                <input type="text" name="name" required="required" style="font-family: 'Baloo Bhaijaan 2', cursive;text-align: left">
                <span class="user textfa">نام</span>
            </div>

            <div class="inputBox">
                <input type="number" name="number" required="required" style="font-family: 'Baloo Bhaijaan 2', cursive;  ">
                <span class="textfa">شماره تلفن</span>
            </div>

            <button class="enter" type="submit" style="font-weight: 590">Enter</button>

        </div>
    </form>

</div>
<div class="container" style="min-height: 8vh;display: flex; align-items: center;justify-content: center;">
    <a href="tel:123"> <button class="callbutton" style="font-family: 'Baloo Bhaijaan 2', cursive;">
            123
        </button></a>
</div>



</body>
</html>

