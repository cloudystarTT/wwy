<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathering with You</title>
</head>
<body>
    
    <img src="weather.png" >
    <center>
    <a href="register.php"><button class="start">Get Started</button></a></center>
</body>
</html>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        /* display: flex; */
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background: rgb(234, 234, 240);
        background: linear-gradient(90deg , rgba(234,234,240,1) 0%,
        rgba(79,10,167,0.9783653846153846) 100%,rgba(0,212,255,1) 100%);
        /* background-image: linear-gradient(red,yellow,blue); */
    }
    img{
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .start{
        text-align: center;
        margin-right: 20px;
        border-radius: 10px;
        font-size: 30px;
    }
</style>