<?php
// used by both newform.php and repeatvisitor.php, so we include it.

function printme($id, $name1,$name2,$email,$nick,$subscribe,$url) { 

//$id = time(); // secs since epoch is a uniq number, since we are single threaded. this has other uses too ( as we can track first visit time this way ) - UTC time.
//$id = str_pad($id, 05, '0',STR_PAD_LEFT); // 1D barcode must be 10 chars/digits long exctly!

// //$id = str_pad($id, 15, '0',STR_PAD_LEFT); // 1D barcode must be 15 chars/digits long exctly!

//$id is now externally generated, as we use it elsewhere

// future use, when the scanner supports it: 
// 2D barcode: , note that the ! char represents the length of the barcode (30 ) + built-in checksum (3), so it's char(33)
//$barcode = '[ESC]$[NUL][NUL][GS](k![NUL]0P0dataheredataheredatahere123456[GS](k[ETX][NUL]0Q0[NUL]';

// 1D barcode:  [SI] = char(15) = length of barcode data , can change it if you want to also change padding above
// 1D barcode:  [LF] = char(10) = length of barcode data , can change it if you want to also change padding above
$barcode = '[GS]h9[GS]w[STX][GS]kE[LF]'.$id.'[NUL]';

// some more esc/pos epson codes: 
$boldtext = '[ESC]!(';
$normaltext = '[ESC]![FF]';

// display at top, in bigger text:
$name = "Name:  $name1 $name2\n\n";

//  assemble major bits: 
$data = $boldtext.$name.$normaltext.
"Visitor ID: $id
Email: $email
Nick: $nick
".$barcode;

// add EPSON esc/pos header and footer 
$head = "[27]![8]"; // start of job
$end = "\n\n\n\n\n\n[27]i\n\n[12]\n";  // end of job and cut commands 
$body = $head.$data.$end;

// convert human-readable ESC/POS pseudo-codes into actual binary ESC/POS format for printer:
        $body  = str_replace('[2]', chr(2), $body);
        $body  = str_replace('[8]', chr(8), $body);
        $body  = str_replace('[12]', chr(12), $body);
        $body  = str_replace('[13]', chr(13), $body);
        $body  = str_replace('[27]', chr(27), $body);
        $body  = str_replace('[29]', chr(29), $body);

        $body  = str_replace('[STX]', chr(2), $body);
        $body  = str_replace('[BS]', chr(8), $body);
        $body  = str_replace('[FF]', chr(12), $body);
        $body  = str_replace('[CR]', chr(13), $body);
        $body  = str_replace('[ESC]', chr(27), $body);
        $body  = str_replace('[GS]', chr(29), $body);
        $body  = str_replace('[NUL]', chr(0), $body);
        $body  = str_replace('[ETX]', chr(3), $body);
        $body  = str_replace('[SI]', chr(15), $body);
        $body  = str_replace('[LF]', chr(10), $body);
$data = $body;

?>
<html>
                                <head>
                                <script type="text/javascript">
                                        function load()
                                        {
                                                window.open('http://localhost:80/printer.php?printme=<?php
                                                                echo base64_encode($data);
                                                                ?>','epson_window','width=1,height=1');
                                        <?php if ( $url != '' ) { ?> document.location.href = '<?=$url?>'; <?php } ?>
                                                return false;
                                        }
                                </script>
                                </head>
                                <body onLoad="load()">
                                        <pre>
                                        <!-- <?= $data; ?> -->
                                        </pre>
                                </body>
                                </html>
<?php
} 
?>
