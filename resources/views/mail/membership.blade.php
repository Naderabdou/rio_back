<!DOCTYPE html>
<html>

<head>
    <title>{{ transWord('طلب عضويه جديد') }}</title>
</head>

<body>
    <div style="width: 600px; padding: 15px; margin: 0 auto; background-color: #f8f9fa; font-family: Arial, sans-serif;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{  asset('storage/'. getSetting('logo')) }}" alt="Website Icon" style="width: 50px; height: 50px;">
            <h2 style="color: #6c757d;">طلب عضويه جديد</h2>
        </div>
        <div style="padding: 20px; background-color: #fff; border: 1px solid #dee2e6;">
            <p style="font-size: 16px; color: #6c757d;"> Hallo</p>
            <p style="font-size: 16px; color: #6c757d;">You have a new membership request from the user 
                {{ $membership['name'] }} {{ transWord('with the email') }} {{ $membership['email'] }}.</p>
            <p style="font-size: 16px; color: #6c757d;">
                Please review the request and take the necessary actions.</p>
        </div>
        <div style="text-align: center; margin-top: 20px;">

            <p style="font-size: 14px; color: #6c757d;">

                {{ __('كل الحقوق محفوظة') }} {{ getSetting('name_website', app()->getLocale()) }} &copy;
                {{ date('Y') }}
            </p>
        </div>
    </div>
</body>

</html>
