<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Android</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('backend/css/emulatorMobile.css')}}">
</head>
<body>
    <div class="container-android">
        <div class="login" style="display: flex;
        flex-direction: column;
        justify-content: space-evenly;">
            <div style="font-size: 30px; font-weight: 900; padding: 0.5rem 0.5rem; display: flex; justify-content: center; align-items: flex-start; width: 100%;">
                Enter App ID
            </div>
            <form  action="">
                <input type="text" id="ipt-app-id" style="border-radius: 20px 0px 0px 20px;">
                <input type="submit" value = "Submit" id="">
            </form>
        </div>
        <div class="media" style="display: none;">
            <div class="screen">
                <video src="" controls>

                </video>
                <img src="" alt="" srcset="">
            </div>
            <div class="btn-skip-image">Skip Image</div>
            <div class="control">
                <div is-paused= true class="btn-control btn-play"></div>
            </div>
        </div>
        
    </div>
        <script src="{{asset('/backend/js/emulatorMobile/emulatorMobile.js')}}">
        </script>
</body>

</html>