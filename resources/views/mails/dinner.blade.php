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
                <span style="margin:0 0 0 15px; padding:5px 11px 5px 10px; display:inline-block; border-radius:5px; border:solid 2px #000;">
                    Your dinner code: {{ $voucher->coupon->coupon }}
                </span>
            </td>
        </tr>
    </table>
</body>
</html>
