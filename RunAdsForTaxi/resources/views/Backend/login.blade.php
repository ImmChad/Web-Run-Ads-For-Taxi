<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Set Icon Logo -->
    <link rel="icon" href="{{ asset('uploads/images/logo.png') }}"> 
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #ffffff;
        }

        .background {
            width: 100%;
            height: 100vh;
            position: absolute;
        }

        .background-up {
            width: 100%;
            height: 100%;
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;

            background-color: rgba(255, 255, 255, 0);
        }

        .background .shape {
            height: 1px;
            width: 1px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#ad1847,
                    #f65823);
            box-shadow: #f65823 20px 20px 200px 200px;
            left: 25%;
            top: 25%;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #750000,
                    #c50000);
            box-shadow: #980000 20px 20px 200px 200px;
            right: 25%;
            bottom: 25%;
        }

        form {
            height: 520px;
            width: 400px;
            /* background-color: rgba(255, 255, 255, 0.13); */
            position: absolute;
            /* transform: translate(-50%, -50%); */
            /* top: 50%;
            left: 50%; */
            border-radius: 50px;
            /* backdrop-filter: blur(10px); */
            
            border: 4px solid #c82e2e;
            /* box-shadow: 0 0 40px rgba(8, 7, 16, 0.6); */
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #000000;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            /* margin-top: 30px; */
            font-size: 16px;
            font-weight: 700;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            border-radius: 20px;
            border: 3px solid #c82e2e;
            background-color: rgba(255, 255, 255, 0.07);
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #767676;
        }

        button {
            margin-top: 30px;
            width: 100%;
            border-radius: 20px;
            background-color: #c82e2e;
            color: #ffffff;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px;
            background-color: rgba(71, 71, 71, 0.27);
            color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .social div:hover {
            background-color: rgba(46, 46, 46, 0.47);
        }

        .social .fb {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 25px;
        }
        .social .go {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .social i {
            margin-right: 4px;
        }

        /* CSS TOAASST */
        .toast{
            position: absolute;
            top: 25px;
            right: 30px;
            border-radius: 12px;
            background: #fff;
            padding: 20px 35px 20px 25px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            border-left: 6px solid #ff0000;
            overflow: hidden;
            transform: translateX(calc(100% + 30px));
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
            z-index: 9;
            display: none;
        }

        .toast.active{
            transform: translateX(0%);
            opacity: 1 !important;
            display: block;
        }

        .toast .toast-content{
            display: flex;
            align-items: center;
        }

        .toast-content .check{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 35px;
            width: 35px;
            background-color: #ff0000;
            color: #fff;
            font-size: 20px;
            border-radius: 50%;
        }

        .toast-content .message{
            display: flex;
            flex-direction: column;
            margin: 0 20px;
        }

        .message .text{
            font-size: 20px;
            font-weight: 400;;
            color: #666666;
        }

        .message .text.text-1{
            font-weight: 600;
            color: #333;
        }

        .toast .close{
            position: absolute;
            top: 10px;
            right: 15px;
            padding: 5px;
            cursor: pointer;
            opacity: 0.7;
        }

        .toast .close:hover{
            opacity: 1;
        }

        .toast .progress{
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: #ddd;
        }

        .toast .progress:before{
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-color: #ff0000;
        }

        .progress.active:before{
            animation: progress 5s linear forwards;
        }

        @keyframes progress {
            100%{
                right: 100%;
            }
        }
    </style>
</head>

<body>
    {{-- <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div> --}}
    <div class="background-up">
        <form action="{{URL::to('/login-admin')}}" method="post">
            {{ csrf_field() }}
            <h1 class="purples" style="font-size: 50px">Login</h1>
    
            <label for="username">Num Phone</label>
            <input type="text" placeholder="Enter Num Phone ..." name="numPhone" id="numPhone">
    
            <label for="password">Password</label>
            <input type="password" placeholder="Enter password ..." name="password" id="password">
    
            <button class="login-admin">LOGIN</button>
            {{-- <div class="social">
                <div class="go"><i class="fa fa-google" aria-hidden="true"></i>Google</div>
                <div class="fb"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</div>
            </div> --}}
        </form>
    </div>

    <div class="toast">
        <div class="toast-content">
            <i class="fa fa-info check" aria-hidden="true"></i>
            {{-- <i class="fa-solid fa-circle-info"></i> --}}


            <div class="message">
                <span class="text text-1">Notification!!!</span>
                <span class="text text-2">Your changes has been saved</span>
            </div>
        </div>
        {{-- <i class="fa-solid fa-xmark close"></i> --}}
        <i class="fa fa-times close" aria-hidden="true" style="font-size: 20px;"></i>
        <div class="progress"></div>
    </div>

</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function displayToast(mess) {
            document.querySelector('.toast .text.text-2').textContent = mess;
            document.querySelector('.toast').classList.add('active');
            document.querySelector('.progress').classList.add('active');
    
    
            let time = setTimeout(() => {
                document.querySelector('.toast').classList.remove("active");
                document.querySelector('.progress').classList.remove("active");
            }, 5000); //1s = 1000 milliseconds
    
            document.querySelector(".toast .close").addEventListener("click", () => {
                document.querySelector('.toast').classList.remove("active");
                
                setTimeout(() => {
                    document.querySelector('.progress').classList.remove("active");
                }, 300);
    
                clearTimeout(time);
            });
        }
    
        @if(isset($messToast))
            displayToast('{{ $messToast }}');
        @endif
    </script>


</html>
