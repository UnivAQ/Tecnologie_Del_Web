/* $Id$ */

if (Drupal.jsEnabled) {
  var google_safe = 'high';
  var google_num_ads_skip = 0;
  var urchin_max, urchin_channel, ga_account;

  /**
   * This function is required and is used to display the ads that are returned 
   * from the JavaScript request. You should modify the document.write commands 
   * so that the HTML they write out fits with your desired ad layout.
   */
  function google_ad_request_done(google_ads) {
    var s = '';
    // s += '<span class="credit">Sponsored Links</span>';
    var i;
  
    /* Verify that there are actually ads to display. */
    if (google_ads.length == 0) return;

    /* Keep running total of ads returned to ads do no repeat on page. */
    google_num_ads_skip += google_ads.length;

    /**
      * If an image or Flash ad is returned, display that ad. If a rich media 
      * ad is returned, display that as "as is." Otherwise, build a string 
      * containing all of the ads and then use a document.write() command to 
      * print that string.
      */
    if (google_ads[0].type == "image") {
      urchin_max = 1; // only 1 ad will be returned, so reflect that in ad tracking
      s += '<div><a href="' + google_ads[0].url 
        + '" target="_blank" title="go to ' + google_ads[0].visible_url 
        + '"><img border="0" src="' + google_ads[0].image_url 
        + '"width="' + google_ads[0].image_width 
        + '"height="' + google_ads[0].image_height 
        + '"></a></div>';
    }

    else if (google_ads[0].type == "flash") {
      urchin_max = 1; // only 1 ad will be returned, so reflect that in ad tracking
      s += '<div><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' 
        + ' codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"' 
        + ' WIDTH="' + google_ad.image_width 
        + '" HEIGHT="' + google_ad.image_height + '">' 
        + '<PARAM NAME="movie" VALUE="' + google_ad.image_url + '">' 
        + '<PARAM NAME="quality" VALUE="high">' 
        + '<PARAM NAME="AllowScriptAccess" VALUE="never">' 
        + '<EMBED src="' + google_ad.image_url 
        + '" WIDTH="' + google_ad.image_width 
        + '" HEIGHT="' + google_ad.image_height 
        + '" TYPE="application/x-shockwave-flash"' 
        + ' AllowScriptAccess="never" ' 
        + ' PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED></OBJECT></div>';
    }    

    else if (google_ads[0].type == "html") {
      urchin_max = 1; // only 1 ad will be returned, so reflect that in ad tracking
      s += '<div>' + google_ads[0].snippet + '</div>';
    }
        
    else {
      /* For text ads, append each ad to the string. */
      for (i=0; i < google_ads.length; ++i) {
        var status = ' onmouseout="window.status=\'\'" ' + 'onmouseover="window.status=\'go to ' + google_ads[i].visible_url + '\'; return true;" ';
        var url_wrap = google_ads[i].visible_url.replace(/\//g, "/<wbr/>");

        s += '<div>' 
          + '<a href="' + google_ads[i].url + '" target="_blank"' + status + '>' 
          + '<span class="title">' + google_ads[i].line1 + '</span>' 
          + '<span class="description">' +google_ads[i].line2 + ' ' + google_ads[i].line3 + '</span>' 
          + '<span class="site">' + url_wrap + '</span></a>' 
          + '</div>';
      }
    }

    document.write(s);

    // Google ad tracking.
    $('body').append('<script type="text/javascript">_uacct = "' + ga_account + '";urchinTracker("/ads/track/afc/' + urchin_channel + '/' + google_ads[0].type + '/' + urchin_max + '/' + google_ads.length + '");</script>');

    return;
  }

  $(document).ready(function() {
  });
}
