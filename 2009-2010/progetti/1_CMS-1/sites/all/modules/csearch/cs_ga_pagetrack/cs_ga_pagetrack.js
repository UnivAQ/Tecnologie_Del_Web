if (Drupal.jsEnabled) {
  $(document).ready(function() {

    /*
     * GLOBAL SETTINGS
     */
    var ga = Drupal.settings.googleanalytics;
    var csga = Drupal.settings.cs_ga_pagetrack;
    var pathname = window.location.pathname;

    // if a virtual_url has been specified, check to see if it's an array
    if (csga.virt_url) {

      // if it's an array, grab the first value as that is page type
      if (csga.virt_url instanceof Array) {
        var virt_url = csga.virt_url.shift();
      }
      // else use the string that's passed
      else {
        var virt_url = csga.virt_url;
      }
    }
    // else if no virtual url is defined, use the pathname
    else {
      var virt_url = '/undefined' + pathname;
    }

    if (csga.debug) {
      alert('virtpath: ' + virt_url + "\n" + 
      '_uacct: ' + _uacct + "\n" +
      ' gaLegacy: ' + ga.LegacyVersion); 
    }

    var csPageTrack = function(virtpath) {
      // if ga uacct is specified in drupal settings, let's add it here
      // this way uacct will get set regardless of header/footer 
      if (csga._uacct) {
        var _uacct = csga._uacct;
      }
    
      if (ga.LegacyVersion) {
        urchinTracker(virtpath);
      }
      else {
        pageTracker._trackPageview(virtpath);
      }
      if (csga.debug) {
        alert('virtpath: ' + virtpath + "\n" + 
        '_uacct: ' + _uacct + "\n" +
        ' gaLegacy: ' + ga.LegacyVersion); 
      }
    }
    /*
     * END OF GLOBAL SETTINGS
     */

    // ticket #1696 - assign virt_url value to the SignupVirtualURL newsletter field
    $('[name=SignupVirtualURL]').val(virt_url)

    // ticket #1713 - add click event tracking for Radlinks
    $('#radlink_nodeapi .ad a').click(function() {
      var prefix = '/events/adsense_radlink';
      var page = virt_url;
      var tracker = prefix + page;
      csPageTrack(tracker);
      if (csga.debug) {
        alert('tracker: ' + tracker); 
        return false;
      }
    });

    // ticket #1530 - Add event tracking to RSS chicklets
    $('#footer_content #rss_feeds a').click(function() {
      var prefix = '/events/rss-click/';
      var page = $(this).attr("class");
      var tracker = prefix + page;
      csPageTrack(tracker);
      if (csga.debug) {
        alert('tracker: ' + tracker); 
        return false;
      }
    });
    
    $('#sidebar-left #rss .rssimg a').click(function() {
      var prefix = '/events/rss-click/';
      var page = $(this).attr("class");
      var tracker = prefix + page;
      csPageTrack(tracker);
      if (csga.debug) {
        alert('tracker: ' + tracker); 
        return false;
      }
    });

    $('#sidebar-right #block-views-Blog_recent_channels .blog-recent-header-rss a, #sidebar-right #block-views-Blog_recent_channels .blog-recent-footer-rss a').click(function() {
      var tracker = '/events/rss-click/blog-getfeeds';
      csPageTrack(tracker);
      if (csga.debug) {
        alert('tracker: ' + tracker); 
        return false;
      }
    }); 

  }); // close document.ready
}