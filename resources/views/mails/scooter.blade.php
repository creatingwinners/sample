<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mailtemplate</title>
    <style>
        body{font-family:Arial, Helvetica; font-size:14px; line-height:22px;}
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0" style="width:600px;" align="center">
        <tr>
            <td width="50%;">
                <div style="padding:10px 0 10px 0; text-align:center; border-radius:10px; background-color:#b1cce2;">
                    <h1 style="color:#FFF; font-size:28px; font-weight:bold; line-height:32px">
                        Grats
                    </h1>
                </div>
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="margin-top:50px; width:600px;" align="center">
        <tr>
            <td>
                <p style="margin-bottom:30px;">
                    Go to
                    <a href="{{ route('voucher.address', [\Hashids::encode($voucher->id)]) }}" style="margin-top:23px; padding:10px 15px 10px 14px; display:inline-block; color:#000; font-size:15px; font-weight:bold; text-decoration:none; border:solid 2px #000; border-radius:10px; background-color:#fabe3b;">Klik hier om je gegevens in te voeren</a>
                    and fill in your address to get price
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
