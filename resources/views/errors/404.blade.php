<!DOCTYPE html>
<html lang="en">

<head>
    <title>Error_404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        * {
            margin: 0 auto;
            background: #cddfe0;
        }

        .container {
            position: relative;
            top: 70px;
            text-align: center;
            height: 100vh;
        }
    </style>

<body>

    <div class="container">
        <div>
            <h1 style="color: blue;">{{ $exception->getMessage() }}</h1>
            <p style="margin-top: 260px;">Looks like the page you are trying to visit does not exist
                <br> Please check the URL and Try again.
            </p>
        </div>
        <div class="home">

        </div>
    </div>

</body>

</html>
