    function addmsg(typ, msg){
        /* Simple helper to add a div.
        type is the name of a CSS class (white/green/red).
        msg is the contents of the div */
        //$("#messages").append( "<div class='msg alert alert-success "+ type +"'>"+ msg +"</div>");
        $('div.msg').replaceWith( "<div class='msg alert "+ typ +"'>"+ msg + " <br> </div>");
	//$.bootstrapGrowl(msg, { type: typ, align: 'center', width: 'auto', ]);
        $.x += 1;
    }

    function waitForMsg(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "GET",
            url: "msgsrv.php",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to msgsrv.php completes */
                //<font color=grey>(poll count: " + $.x +") </font>
                addmsg("alert-success", data); /* Add response to a .msg div (with the "green" class)*/
                setTimeout(
                    waitForMsg, /* Request next message */
                    1000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                //addmsg("red", textStatus + " (" + errorThrown + ")");
                addmsg("", "");
                setTimeout(
                    waitForMsg, /* Try again after.. */
                    1000); /* milliseconds (1seconds) */
            }
        });
    };

