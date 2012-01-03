#!/usr/bin/php
<?php
/*
# Copyright (c) 2012 Expression Technologies <info@expressiontech.org>
# Copyright (c) 2012 SiNA <sina@redteam.io>
# Copyright (c) 2012 The Tor Project, Inc
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation; either version 3 of the
# License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
# USA
#
*/

error_reporting(E_ALL & E_STRICT);

include 'lib/XMPPHP/XMPP.php';
require_once 'lib/config-gmail-user.php';


#Use XMPPHP_Log::LEVEL_VERBOSE to get more logging for error reports
#If this doesn't work, are you running 64-bit PHP with < 5.2.6?
$conn = new XMPPHP_XMPP('talk.google.com', 5222, GMAIL_USER, PASSWORD, 'xmpphp', 'GMAIL_DOMAIN', $printlog=true, $loglevel=XMPPHP_Log::LEVEL_INFO);

$conn->autoSubscribe();

$vcard_request = array();

try {
    $conn->connect();
    while(!$conn->isDisconnected()) {
    	$payloads = $conn->processUntil(array('message', 'presence', 'end_stream', 'session_start', 'vcard'));

    	foreach($payloads as $event) {
    		$pl = $event[1];
                  $email_rcv = explode('/', $pl['from']);

    		switch($event[0]) {
    			case 'message':
    				print "Message from: {$pl['from']}\n";
    				print $pl['body'] . "\n";
    				print "---------------------------------------------------------------------------------\n";
				$cmd = explode(' ', $pl['body']);

// Here we hardcode all the packages and languages
                                switch ($cmd[0]) {
                                    case "test":
                                        echo $response = "I've shared an item with you:  {$email_rcv[0]}\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python lib/acl.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
// Arabic
                                    case "ar":
                                        $doctiltle = ''
                           	     shell_exec('python lib/acl.py '. $email_rcv[0] . ' '. $doctiltle );
                                        echo $response = "Please reply with one of the following packages:\n windows_ar\n macos-i386_ar\n macos-x86-64_ar\n linux-i686_ar\n linux-x86-64_ar\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
                                        break;
                                    case "windows_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// CS
                                    case "cs":
                                        echo $response = "Please reply with one of the following packages:\n windows_cs\n macos-i386_cs\n macos-x86-64_cs\n linux-i686_cs\n linux-x86-64_cs\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_ar":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// de
                                    case "de":
                                        echo $response = "Please reply with one of the following packages:\n windows_de\n macos-i386_de\n macos-x86-64_de\n linux-i686_de\n linux-x86-64_de\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_de":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_de":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_de":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_de":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_de":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// en
                                    case "en":
                                        echo $response = "Please reply with one of the following packages:\n windows_en\n macos-i386_en\n macos-x86-64_en\n linux-i686_en\n linux-x86-64_en\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_en":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_en":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_en":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_en":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_en":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;


// es
                                    case "es":
                                        echo $response = "Please reply with one of the following packages:\n windows_es\n macos-i386_es\n macos-x86-64_es\n linux-i686_es\n linux-x86-64_es\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_es":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_es":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_es":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_es":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_es":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// fa
                                    case "fa":
                                        echo $response = "Please reply with one of the following packages:\n windows_fa\n macos-i386_fa\n macos-x86-64_fa\n linux-i686_fa\n linux-x86-64_fa\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_fa":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_fa":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_fa":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_fa":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_fa":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;


// fr
                                    case "fr":
                                        echo $response = "Please reply with one of the following packages:\n windows_fr\n macos-i386_fr\n macos-x86-64_fr\n linux-i686_fr\n linux-x86-64_fr\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_fr":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_fr":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_fr":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_fr":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_fr":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// hu
                                    case "hu":
                                        echo $response = "Please reply with one of the following packages:\n windows_hu\n macos-i386_hu\n macos-x86-64_hu\n linux-i686_hu\n linux-x86-64_hu\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_hu":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_hu":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_hu":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_hu":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_hu":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// it
                                    case "it":
                                        echo $response = "Please reply with one of the following packages:\n windows_it\n macos-i386_it\n macos-x86-64_it\n linux-i686_it\n linux-x86-64_it\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_it":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_it":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_it":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_it":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_it":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
// nl
                                    case "nl":
                                        echo $response = "Please reply with one of the following packages:\n windows_nl\n macos-i386_nl\n macos-x86-64_nl\n linux-i686_nl\n linux-x86-64_nl\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_nl":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_nl":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_nl":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_nl":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_nl":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

// zh
                                    case "zh":
                                        echo $response = "Please reply with one of the following packages:\n windows_zh\n macos-i386_zh\n macos-x86-64_zh\n linux-i686_zh\n linux-x86-64_zh\n";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "windows_zh":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "macos-i386_zh":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                    case "macos-x86-64_zh":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-i686_zh":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;
                                   case "linux-x86-64_zh":
                                        echo $response = "Package is on its way, please check your email!";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
				     shell_exec('python ./share.py '. $email_rcv[0] . ' '. $argv[1] );
                                        break;

                                    default:
                                        echo $response = "Please reply with one the following languages: ar, cs, de, en, es, fa, fr, hu, it, nl, zh ";
                                        $conn->message($pl['from'], $body=$response, $type=$pl['type']);
                                        break;
                                }
    			break;
    			case 'presence':
    				print "Presence: {$pl['from']} [{$pl['show']}] {$pl['status']}\n";
    			break;
    			case 'session_start':
    			    print "Session Start\n";
			    	$conn->getRoster();
    				$conn->presence($status="Online!");
    			break;
    		}
    	}
    }
} catch(XMPPHP_Exception $e) {
    die($e->getMessage());
}
