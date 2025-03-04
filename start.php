<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathering with You</title>
</head>
<body>
    <div class = "container">
        <div class="sub-div">
            <img class = "title" src="images/weather.png" >
            <a href="register.php"><button class="start-button">Get Started</button></a></center>
            <img class = "dotted" src="images/polka.png">
        </div>
    </div>
</body>
</html>

<style>
    html, body {
                height: 100%;
                width: 100%;
                margin: 0;
                padding: 0;
                overflow: hidden;
                font-family: Arial, sans-serif;
            }
            
            .container {
                height: 100vh;
                width: 100vw;
                background: linear-gradient(to bottom, white 10%, #4C1087 90%);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                box-sizing: border-box;
            }
            .sub-div{
                height: 100vh;
                width: 50vw;
                padding-right: 40%;
                margin-top: 90%;
            }

            .title {
                font-size: 3rem;
                font-weight: bold;
                color: #06000D;
                margin-bottom: -120px; /* Space between title and button */
                width: 150%; /* 50% of the container's width */
                height: auto; /* Maintain aspect ratio */
                padding-bottom: 20px;
            }

            .start-button {
                background-color: #06000D;
                color: white;
                border: none;
                padding: 15px 30px;
                border-radius: 90px;
                font-size: 1.2rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
                color: #C497EF;
            }

            /* Add a line design to the button */
            .start-button::before {
                content: '';
                position: absolute;
                top: 398px;
                left: 00%; /* Start the line outside the button */
                width: 10%;
                height: 2px; /* Thickness of the line */
                background: black; /* Color of the line */
                transition: left 0.3s ease; /* Animate the line */
            }

            .start-button::after {
                content: '';
                position: absolute;
                bottom: 442px;
                right: -10%; /* Start the line outside the button */
                width: 60%;
                height: 1.5px; /* Thickness of the line */
                background: black; /* Color of the line */
                transition: right 0.3s ease; /* Animate the line */
            }

            .start-button:hover {
                background-color: #3e0d78;
            }

            .dotted {
                margin-left: -60px;
        
            }

    
</style>