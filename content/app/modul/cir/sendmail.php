<?php
error_reporting(0);
include("../../../../config/koneksi.php");
//EMAIL NOTIFIKASI
date_default_timezone_set('Etc/UTC');
/*autoload phpmailer*/
require 'PHPMailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance

$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "krisanthium.op@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "KOP192315";

//Set who the message is to be sent from
$mail->setFrom('krisanthium.op@gmail.com', 'e-customerCare@krisanthium.com');

//Set an alternative reply-to address
$mail->addReplyTo('krisanthium.op@gmail.com', 'e-customerCare@krisanthium.com');

//Set who the message is to be sent to
$mail->addAddress("$_POST[cust_info]", "$_POST[comp_name]");
//Set the subject line
$mail->Subject = "INFO! Penerimaan Laporan PT. Krisanthium Offset Printing";
$mail->Body    = "<p>Yth. <strong> $_POST[comp_name]</strong><br><br>Bersama dengan email ini, Kami memberitahukan bahwa laporan yang Bapak/Ibu kirim telah Kami terima.<br><br>
					<table border='0' width='100%'>
					<tr><td>Nama Produk</td><td>: $_POST[comp_name]</td></tr>
					<tr><td>Kode Material</td><td>: $_POST[prod_name]</td></tr>
					<tr><td>No. <i>Good Issue</i></td><td>: $_POST[gid]</td></tr>
					</table><br>
					Pihak Kami akan segera melakukan pengecekan dan tindakan yang sebagaimana mestinya.<br>
					Untuk informasi selanjutnya, akan diinfokan oleh Pihak Marketing/Sales PT. Krisanthium Offset Printing.
					<br>
					Terima kasih atas informasi dan perhatiannya<br><br>
					Salam hormat,<br>
					PT. Krisanthium Offset Printing
					<br><br><br><br>
					<font size='2'><i>Pesan ini dikirim secara otomatis oleh sistem, sehingga tidak perlu balas pesan ini.</i></font></p>
					<br>
					<hr>
					<table border='0' width='50%'>
						<tr><td width='4%'><font size='2' color='grey'>Email</font></td><td><font size='2' color='grey'>: sales@krisanthium.com</font></td></tr>
						<tr><td width='4%'><font size='2' color='grey'>Phone</font></td><td><font size='2' color='grey'>: (031) 8438182</font></td></tr>
						<tr><td width='4%'><font size='2' color='grey'>Website</font></td><td><font size='2' color='grey'>: <a href='http://www.krisanthium.com/'>www.krisanthium.com</a></font></td></tr>
						<tr><td width='4%'><font size='2' color='grey'>Instagram</font></td><td><font size='2' color='grey'>: <a href='https://instagram.com/krisanthiumoffsetprinting'>krisanthiumoffsetprinting</a></font></td></tr>
					</table>";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';


//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "";
}

$mail2 = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail2->isSMTP();

$mail2->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail2->Debugoutput = 'html';

//Set the hostname of the mail server
$mail2->Host = 'smtp.gmail.com';
// use
// $mail2->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail2->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail2->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail2->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail2->Username = "krisanthium.op@gmail.com";

//Password to use for SMTP authentication
$mail2->Password = "KOP192315";

//Set who the message is to be sent from
$mail2->setFrom('krisanthium.op@gmail.com', 'e-customerCare@krisanthium.com');

//Set an alternative reply-to address
$mail2->addReplyTo('krisanthium.op@gmail.com', 'e-customerCare@krisanthium.com');

//Set who the message is to be sent to
$mail2->addAddress("sales@krisanthium.com", "Sales Krisanthium");
//Set the subject line
$mail2->Subject = "ATTENTION! Customer Information Report - $_POST[comp_name], $_POST[prod_name]";
$mail2->Body    = "Dear Marketing/Sales, <br><strong> PT. Krisanthium Offset Printing</strong><br><br>Berikut ini ada laporan Customer Information Report (CIR) :<br><br>
					<table border='0' width='100%'>
					<tr><td>Customer Name</td><td>: $_POST[comp_name]</td></tr>
					<tr><td>Material Code</td><td>: $_POST[prod_name]</td></tr>
					<tr><td>Good Issue No.</td><td>: $_POST[gid]</td></tr>
					<tr><td>Link</td><td>: <a href='http://vpn.krisanthium.com/ncr/content/app/page.php?n=list-cir&act=detail&code=$cir'>KLIK UNTUK MELIHAT LAPORAN</a></td></tr>
					
					</table><br><br>
					<font size='2'><i>Pesan ini dikirim secara otomatis oleh sistem, sehingga tidak perlu balas pesan ini.</i></font>
					<br><br><br><br><br><br><br><br>
					<hr>
					<table border='0' width='50%'>
						<tr><td width='4%'><font size='2' color='grey'>Email</font></td><td><font size='2' color='grey'>: sales@krisanthium.com</font></td></tr>
						<tr><td width='4%'><font size='2' color='grey'>Phone</font></td><td><font size='2' color='grey'>: (031) 8438182</font></td></tr>
						<tr><td width='4%'><font size='2' color='grey'>Website</font></td><td><font size='2' color='grey'>: <a href='http://www.krisanthium.com/'>www.krisanthium.com</a></font></td></tr>
						<tr><td width='4%'><font size='2' color='grey'>Instagram</font></td><td><font size='2' color='grey'>: <a href='https://instagram.com/krisanthiumoffsetprinting'>krisanthiumoffsetprinting</a></font></td></tr>
					</table>
					";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

//Replace the plain text body with one created manually
$mail2->AltBody = 'This is a plain-text message body';


//send the message, check for errors
if (!$mail2->send()) {
    echo "Mailer Error: " . $mail2->ErrorInfo;
} else {
    echo "";
}
?>