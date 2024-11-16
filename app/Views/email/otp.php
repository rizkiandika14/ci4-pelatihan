<?php
//split otp into 3 part
$otpPrint = str_split(($otp ?? '#######'), 3);
?>
<div style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <h4>Kepada <?= $fullname ?? '_FULLNAME_' ?>,</h4>
    <p> Kode otentifikasi:</p>
    <p style="margin-left: 2em; font-size: 1.5em;"><strong style="margin-right: 0.5em;"><?= $otpPrint[0] ?></strong><strong style="margin-right: 0.5em;"><?= $otpPrint[1] ?></strong></p>
    <p>Kode ini hanya berlaku selama 2 menit. Terimakasih</p>

    <small style="color: gray; font-size: 0.75em;">
        <p>Apabila anda merasa tidak melakukan aktivitas tertentu dalam Smart Nusa Jayananta, harap abaikan email ini.</p>
        <p>Harap untuk tidak membalas email ini.</p>
    </small>
</div>