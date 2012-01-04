#!/usr/bin/php -f
<?php

$log = './googbot-daemon.log';

include 'lib/XMPPHP/XMPP.php';
require_once 'lib/config-gmail-user.php';

error_reporting(E_ALL & E_STRICT);

#Use XMPPHP_Log::LEVEL_VERBOSE to get more logging for error reports
#If this doesn't work, are you running 64-bit PHP with < 5.2.6?
$conn = new XMPPHP_XMPP('talk.google.com', 5222, GMAIL_USER, GMAIL_PASS, 'xmpphp', GMAIL_DOMAIN, $printlog=true, $loglevel=XMPPHP_Log::LEVEL_INFO);
$conn->autoSubscribe();
$vcard_request = array();


//fork the process to work in a daemonized environment
file_put_contents($log, "Status: starting up.\n", FILE_APPEND);
$pid = pcntl_fork();
if($pid == -1){
	file_put_contents($log, "Error: could not daemonize process.\n", FILE_APPEND);
	return 1; //error
}
else if($pid){
	return 0; //success
}
else{
    //the main process
    while(true){
//        ob_start();
            try {

        $conn->connect();
        while(!$conn->isDisconnected()) {
        	$payloads = $conn->processUntil(array('message', 'presence', 'end_stream', 'session_start', 'vcard'));
        	foreach($payloads as $event) {
        		$pl = $event[1];
                        $email_rcv = explode('/', $pl['from']);
        		switch($event[0]) {
        			case 'message':
        				 echo $msg = "Message from: {$pl['from']}"."\n";
					echo $msg = "{$pl['body']}"."\n";

    				$cmd = explode(' ', $pl['body']);
                                     echo $cmd[0];
// Here we hardcode all the packages and languages
                                switch ($cmd[0]) {
                                    case "test":
                                        $response = "I've shared an item with you:  {$email_rcv[0]}\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python lib/acl.py '. $email_rcv[0] . ' '. $title );
                                        break;
// Arabic
                                    case "ar":
                           	        //shell_exec('python lib/acl.py '. $email_rcv[0] . ' '. $doctiltle);
                                        echo $response = "Please reply with one of the following packages:\n windows_ar\n macos-i386_ar\n macos-x86-64_ar\n linux-i686_ar\n linux-x86-64_ar\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
  //                                      $response = ob_get_contents(); ob_end_clean(); file_put_contents($log, $response, FILE_APPEND);
                                        break;
                                    case "windows_ar":
                                        $title = 'tor-browser-ar.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_ar":
                                        $title='tor-browser-osx-i386-dev-fa.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_ar":
                                        $tilte='tor-browser-osx-x86_64-dev-ar.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_ar":
                                        $title='tor-browser-gnu-linux-i686-ar.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_ar":
                                        $title='tor-browser-gnu-linux-x86_64-ar.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// CS
                                    case "cs":
                                        echo $response = "Please reply with one of the following packages:\n windows_cs\n macos-i386_cs\n macos-x86-64_cs\n linux-i686_cs\n linux-x86-64_cs\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_cs":
                                        $title='tor-browser-cs.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_cs":
                                        $title='tor-browser-osx-i386-dev-ar.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_cs":
                                        $tilte='tor-browser-osx-x86_64-dev-cs.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_cs":
                                        $title='tor-browser-gnu-linux-i686-cs.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_cs":
                                        $title='tor-browser-gnu-linux-x86_64-cs.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// de
                                    case "de":
                                        echo $response = "Please reply with one of the following packages:\n windows_de\n macos-i386_de\n macos-x86-64_de\n linux-i686_de\n linux-x86-64_de\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_de":
                                        $tite= 'tor-browser-de.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_de":
                                        $title='tor-browser-osx-i386-dev-de.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_de":
                                        $tilte='tor-browser-osx-x86_64-dev-de.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_de":
                                        $title='tor-browser-gnu-linux-i686-de.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_de":
                                        $title='tor-browser-gnu-linux-x86_64-de.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// en
                                    case "en":
                                        echo $response = "Please reply with one of the following packages:\n windows_en\n macos-i386_en\n macos-x86-64_en\n linux-i686_en\n linux-x86-64_en\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_en":
                                        $tite= 'tor-browser-en-US.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_en":
                                        $title='tor-browser-osx-i386-dev-en-US.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_en":
                                        $tilte='tor-browser-osx-x86_64-dev-en-US.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_en":
                                        $title='tor-browser-gnu-linux-i686-en-US.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_en":
                                        $title='tor-browser-gnu-linux-x86_64-en-US.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;


// es
                                    case "es":
                                        echo $response = "Please reply with one of the following packages:\n windows_es\n macos-i386_es\n macos-x86-64_es\n linux-i686_es\n linux-x86-64_es\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_es":
                                        $tite= 'tor-browser-es-ES.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_es":
                                        $title='tor-browser-osx-i386-dev-es-ES.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_es":
                                        $tilte='tor-browser-osx-x86_64-dev-es-ES.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_es":
                                        $title='tor-browser-gnu-linux-i686-es-ES.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_es":
                                        $title='tor-browser-gnu-linux-x86_64-es-ES.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// fa
                                    case "fa":
                                        echo $response = "Please reply with one of the following packages:\n windows_fa\n macos-i386_fa\n macos-x86-64_fa\n linux-i686_fa\n linux-x86-64_fa\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_fa":
                                        $tite= 'tor-browser-fa.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_fa":
                                        $title='tor-browser-osx-i386-dev-fa.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_fa":
                                        $tilte='tor-browser-osx-x86_64-dev-fa.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_fa":
                                        $title='tor-browser-gnu-linux-i686-fa.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_fa":
                                        $title='tor-browser-gnu-linux-x86_64-fa.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;


// fr
                                    case "fr":
                                        echo $response = "Please reply with one of the following packages:\n windows_fr\n macos-i386_fr\n macos-x86-64_fr\n linux-i686_fr\n linux-x86-64_fr\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_fr":
                                        $tite= 'tor-browser-fr.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_fr":
                                        $title='tor-browser-osx-i386-dev-fr.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_fr":
                                        $tilte='tor-browser-osx-x86_64-dev-fr.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_fr":
                                        $title='tor-browser-gnu-linux-i686-fr.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_fr":
                                        $title='tor-browser-gnu-linux-x86_64-fr.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// hu
                                    case "hu":
                                        echo $response = "Please reply with one of the following packages:\n windows_hu\n macos-i386_hu\n macos-x86-64_hu\n linux-i686_hu\n linux-x86-64_hu\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_hu":
                                        $tite= 'tor-browser-hu.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_hu":
                                        $title='tor-browser-osx-i386-dev-hu.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_hu":
                                        $tilte='tor-browser-osx-x86_64-dev-hu.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_hu":
                                        $title='tor-browser-gnu-linux-i686-hu.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_hu":
                                        $title='tor-browser-gnu-linux-x86_64-hu.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// it
                                    case "it":
                                        echo $response = "Please reply with one of the following packages:\n windows_it\n macos-i386_it\n macos-x86-64_it\n linux-i686_it\n linux-x86-64_it\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_it":
                                        $tite= 'tor-browser-it.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_it":
                                        $title='tor-browser-osx-i386-dev-it.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_it":
                                        $tilte='tor-browser-osx-x86_64-dev-it.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_it":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_it":
                                        $title='tor-browser-gnu-linux-x86_64-it.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
// nl
                                    case "nl":
                                        echo $response = "Please reply with one of the following packages:\n windows_nl\n macos-i386_nl\n macos-x86-64_nl\n linux-i686_nl\n linux-x86-64_nl\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_nl":
                                        $tite= 'tor-browser-nl.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_nl":
                                        $title='tor-browser-osx-i386-dev-nl.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_nl":
                                        $tilte='tor-browser-osx-x86_64-dev-nl.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_nl":
                                        $title='tor-browser-gnu-linux-i686-nl.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_nl":
                                        $title='tor-browser-gnu-linux-x86_64-nl.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

// zh
                                    case "zh":
                                        echo $response = "Please reply with one of the following packages:\n windows_zh\n macos-i386_zh\n macos-x86-64_zh\n linux-i686_zh\n linux-x86-64_zh\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "windows_zh":
                                        $tite= 'tor-browser-zh-CN.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "macos-i386_zh":
                                        $title='tor-browser-osx-i386-dev-zh-CN.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                    case "macos-x86-64_zh":
                                        $tilte='tor-browser-osx-x86_64-dev-zh-CN.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-i686_zh":
                                        $title='tor-browser-gnu-linux-i686-zh-CN.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;
                                   case "linux-x86-64_zh":
                                        $title='tor-browser-gnu-linux-x86_64-zh-CN.zip';
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python acl.py   '. $email_rcv[0] . ' '. $title );
                                        break;

                                    default:
                                        echo $response = "Hello, I am the GoogBot! Please reply with one the following languages: ar, cs, de, en, es, fa, fr, hu, it, nl, zh ";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
                                        break;
                                }
    			break;
    			case 'presence':
    				print "Presence: {$pl['from']} [{$pl['show']}] {$pl['status']}\n";
    			case 'session_start':
    			    print "Session Start\n";
			    	//$conn->getRoster();
    				$conn->presence($status="Online!");
    			break;
    		}
        	    }
}
        }catch(XMPPHP_Exception $e) {

        }
}//end while

    }//end else

?>
