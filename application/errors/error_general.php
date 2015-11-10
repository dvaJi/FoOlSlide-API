<!doctype html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<title>Error</title>
<style type="text/css">
/* ===[ Status.css (c) 2014-2016 Henry - Chocolatkey Studios ]=== */

body, html {
    background: #252525;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin: 0;
    padding: 0;
	height: 100%;
	width: auto;
}

body {
    background-attachment: fixed;
    background-image: url('../../images/jbow.png');
    background-position: 50% 100%,top left;
    background-repeat: no-repeat,repeat;
    background-size: 35%;
}

@-webkit-keyframes blink { 
    0% { opacity: 1 }

    50% { opacity: 0 }

    100% { opacity: 1 }
}

@-moz-keyframes blink { 
    0% { opacity: 1 }

    50% { opacity: 0 }

    100% { opacity: 1 }
}

@-o-keyframes blink { 
    0% { opacity: 1 }

    50% { opacity: 0 }

    100% { opacity: 1 }
}

@keyframes blink { 
    0% { opacity: 1 }

    50% { opacity: 0 }

    100% { opacity: 1 }
}

#container {
    width: 626px;
    height: 256px;
    margin: -128px 0 0 -348px;
    padding: 0 0 0 78px;
    position: absolute;
    top: 30%;
    left: 50%;
}

#container .sorry {
    width: 550px;
    color: #949494;
    font-size: 16px;
    line-height: 24px;
    margin: 0 0 0 35px;
}

#container .sorry *:first-child { margin: 0 }

#container .sorry a {
    color: #cbcbcb;
    text-decoration: none;
    border-bottom: 1px solid #585858;
}

#container .sorry a:hover { color: #e2e2e2 }

#container .leds {
    width: 78px;
    height: 68px;
    overflow: hidden;
    position: absolute;
    top: 44px;
    left: 0;
}

#container .leds .led.green.active.blink {
    background-position: top left;
    -webkit-animation: blink 3s;
    -webkit-animation-iteration-count: infinite;
    -moz-animation: blink 3s;
    -moz-animation-iteration-count: infinite;
    -o-animation: blink 3s;
    -o-animation-iteration-count: infinite;
    animation: blink 3s;
    animation-iteration-count: infinite;
}

#container .leds .led.red.active.blink {
    background-position: bottom right;
    -webkit-animation: blink 3s;
    -webkit-animation-iteration-count: infinite;
    -moz-animation: blink 3s;
    -moz-animation-iteration-count: infinite;
    -o-animation: blink 3s;
    -o-animation-iteration-count: infinite;
    animation: blink 3s;
    animation-iteration-count: infinite;
}

#container .leds .led.green.active { background-position: top left }

#container .leds .led.red.active { background-position: bottom right }

#container .leds .led.green {
    background-position: bottom left;
    float: left;
}

#container .leds .led.red {
    background-position: top right;
    float: right;
}

#container .leds .led {
    width: 39px;
    height: 68px;
    background: url('../../images/leds.png') no-repeat;
}

#container .flip {
    width: 622px;
    height: 152px;
    color: #dadada;
    font-size: 54px;
    font-weight: bold;
    text-align: center;
    line-height: 145px;
    letter-spacing: -2px;
    background: url('../../images/status_flip_container.png') no-repeat;
    position: relative;
}

#container .flip .break {
    width: 584px;
    height: 2px;
    background: #181818;
    border-bottom: 1px solid #343434;
    position: absolute;
    top: 50%;
    left: 19px;
}

#container .flip .break .link.right { right: 10px }

#container .flip .break .link.left { left: 10px }

#container .flip .break .link {
    width: 5px;
    height: 12px;
    background: url('../../images/status_flip_link.png') no-repeat;
    position: absolute;
    top: -3px;
}

/* ===[ Mobile overrides ]=== */

@media (max-height: 500px) {
    body {
        background: none;
    }
}

@media (max-width: 768px) { 
    body {
        background-size: 80%;
    }
    #container {
        width: 100%;
        margin: auto;
        padding: 0px;
        top: auto;
        left: auto;
    }

    #container .flip {
        background: none;
        width: auto;
    }

    #container .break, .leds { display: none }

    #container .sorry {
        width: auto;
        margin: 0 35px 0 35px;
    }
}
</style>
</head>
<body>
    <div id="container">
        <div class="leds">
            <div class="green led"></div>
            <div class="red led"></div>
        </div>
        <div class="leds">
            <div class="green led"></div>
            <div class="red active blink led"></div>
        </div>
        <div class="flip">
            Error
            <div class="break">
                <div class="link left"></div>
                <div class="link right"></div>
            </div>
        </div>
        <div class="sorry">
            <?php
            // Display selected error message
            echo($errordesc);
            if (!$message == '') {
            echo '<p><h1>'.$heading.'</h1>'.$message.'</p>';
            } else {
            echo '<p><a href="javascript:history.go(-1)"><< Go back to previous page.</a></p>';

            }
            ?>
        </div>
    </div>
</body>
</html>