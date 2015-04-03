/* $Id$ */
if (Drupal.jsEnabled) {
  $(document).ready(function() {
    var links = document.getElementsByTagName('a');
    for (var i = 0; i < links.length; i++) {
      if (links[i].href.indexOf('#disqus_thread') >= 0) {
        links[i].innerHTML = '<span class="comment-count">' + links[i].innerHTML.replace('Comment', '</span>Comment');
      }
    }
  });
}
