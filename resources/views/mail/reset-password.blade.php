<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        /* Reset styles to ensure consistency */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header styles */
        .header {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
        }

        /* Logo styles */
        .logo {
            max-width: 150px;
            /* Adjust the width as needed */
        }

        /* Content styles */
        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            /* margin: 0; */
            padding: 20px;
            width: 100%;
            margin: auto;

        }

        .content h2 {
            text-align: center;
        }


        .content p {
            text-align: center;
        }

        img.logo {
            width: 100%;
        }

        /* Button styles */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #08477d;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Footer styles */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <!-- Replace 'logo.png' with your logo image -->
            <a href="{{ route('site.home') }}" target="__blank">
                <img src="{{ asset('storage/' . getSetting('logo')) }}" alt="Logo" class="logo">
            </a>
            <h2> {{ getSetting('name_website', app()->getLocale()) }}</h2>
        </div>
        <div class="content">

            <h2> مرحبا {{ $data['name'] }}</h2>
            <h2> كود التحقق </h2>
            <p> <span style="color:#08477d"> الكود :</span> {{ $data['code'] }} </p>

        </div>
        <div class="footer">
            <p>
                {{ getSetting('footer_desc', app()->getLocale()) }}


            </p>
        </div>
    </div>
</body>

</html>
