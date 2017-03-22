<?php
require_once(SITE_DOC_ROOT ."siteadmin/includes/phpmailer/class.phpmailer.php");
require_once(SITE_DOC_ROOT ."siteadmin/includes/phpmailer/phpmailer.lang-en.php");
/*
* New Addition for mail validation
*/
function check_email_address($email){
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)){
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++){
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])){
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){ // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2){
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++){
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}


function email_send($fromemail, $toemail, $subject, $html_body, $text_body = "") {
     if (EMAIL_DISPLAY) {
        echo "<h1>Sending mail</h1>";
        echo "From: $fromemail<br/>";
        echo "To: $toemail<br/>";
        echo "Subject: $subject<br/>";
        echo "<hr/>";
        echo $html_body;
        echo "<hr/><pre>$text_body</pre><hr/>";
        exit;
    }
    
    if (!EMAIL_ENABLE) return;
    
    $mailer = new PHPMailer();
    $mailer->SetLanguage("en", SITE_DOC_ROOT ."siteadmin/includes/phpmailer/");
    $mailer->PluginDir = SITE_DOC_ROOT ."siteadmin/includes/phpmailer/";
    $mailer->From = $fromemail;
    $mailer->FromName = $fromemail;
    $mailer->Host = MAIL_SERVER;
	$mailer->Hostname = MAIL_SERVER;
    $mailer->Mailer = MAIL_METHOD;
	$mailer->SMTPAuth = TRUE;
    $mailer->Username = MAIL_USERNAME;
    $mailer->Password = MAIL_PASSWORD;
    $mailer->Body = $html_body;
    $mailer->Sender = $fromemail;
    if ($text_body === TRUE) {
        $mailer->AltBody = email_toText($html_body);
    }else if ($text_body != ""){
        $mailer->AltBody = $text_body;
    }
    $mailer->Subject = $subject;
    $mailer->AddAddress($toemail);
    $mailer->AddReplyTo($fromemail);
    $mailer->SMTPDebug = false;
    $mailer->IsHtml(true);
    
    $mailer->AddCustomHeader("X-Sender: " . MAIL_SENDER);
    $mailer->AddCustomHeader("Sender: " . MAIL_SENDER);
    $mailer->AddCustomHeader("Errors-To: " . MAIL_SENDER);
    $mailer->AddCustomHeader("X-AntiAbuse: This is a solicited email from ".MAIL_SERVER_SENDER);
    $mailer->AddCustomHeader("X-AntiAbuse: Servername - {$_SERVER['SERVER_NAME']}");
    $mailer->AddCustomHeader("X-AntiAbuse: User - $fromemail");
    $mailer->AddCustomHeader("Organization: ".MAIL_SERVER_SENDER);
    
    $result = $mailer->Send();
    if (!$result) {
        $err = $mailer->ErrorInfo;
        echo($err);
		return FALSE;
    }else{
		return TRUE;
	}
}

function email_toText($html) {
    # Assemble a text version from the body content
    $text = $html;
    //$text = preg_replace('/<style type="text\/css">.*<\/style>/s',"",$text);

    # Convert HRs
    $text = preg_replace("/<hr\/>/","\n----------------------------------------\n",$text);

    # Replace tables
    $text = preg_replace("/<tr>/","\n",$text);
    $text = preg_replace("/<br\/>/","\n",$text);

    # Convert LI
    $text = preg_replace("/<li[^>]+>/","* ", $text);
    $text = preg_replace("/<\/li>/","\n",$text);

    # Remove all other HTML tags, entities and spaces
    $text = strip_tags($text,"<a>");
    $text = trim($text);
    $text = preg_replace("/\n[ \t]*/","\n",$text);
    $text = preg_replace("/\n\n+/","\n\n",$text);
    $text = email_HTML_decodeEntities($text);

    return $text;
}

/**
 * Turns HTML entities into plain text.  Used when converting HTML emails to text
 */
function email_HTML_decodeEntities($text) {

    $trans = get_html_translation_table(HTML_ENTITIES);

    # Stupidly, PHP 4 does not support longer entities
    # Decode some common ones
    $trans['”'] = '&#8221;';
    $trans['“'] = '&#8220;';
    $trans['€'] = '&#8634;';
    $trans['•'] = '&#8226;';
    $trans['™'] = '&#8482;';
    $trans['†'] = '&#8224;';
    $trans['‡'] = '&#8225;';
    $trans['…'] = '&#8230;';
    $trans['‘'] = '&#8216;';
    $trans['—'] = '&#8212;';
    $trans['–'] = '&#8211;';
    $trans['’'] = '&#8217;';

    # Replace symbolic entities along with new ones defined above
    $text = strtr($text,array_flip($trans));

    # Replace numeric entities
    $text = preg_replace('/&#(\d+);/me',"chr(\\1)",$text);
    $text = preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);
    return $text;
}

function email_GetHeaderBasic(){
        return
        '<style type="text/css">
/* general tag styles */

body {
	font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
	color: #565656;
	background-color: #FFFFFF;
	padding: 0;
	margin: 0;
	text-align: left;
	font-size: 12px;
}

p, td, li, form, label {
	font-size: 12px;
}

td, ul, ol, li, form, input, select {
	padding: 0;
	margin: 0;
}

img {
	padding: 0;
	border: 0;
}

p {
	line-height: 120%;
	padding: 0 5px 10px 10px;
	color: #565656;
	font-weight: normal;
	border: 0;
	margin: 0;
}

a {
	color: #82941B;
	border-bottom: 1px solid #A6D6ED;
	text-decoration: none;
}

a:hover {
	color: #3390BD;
	text-decoration: none;
}

h1, h2, h4 {
    font-size: 16px;
	font-family: Lucida Sans Unicode, Tahoma, Verdana, Arial, Helvetica, sans-serif;
	line-height: 120%;
	padding: 10px 0 10px 10px;
	border: 0;
	margin: 0;
}

.blue {
	color: #0074AC;
}

span {
  color: #CA9360;
}
        </style>';
}

function email_GetFooter(){

}
?>
