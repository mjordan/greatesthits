var url = drupalSettings.greatesthits.url;
var type = drupalSettings.greatesthits.type;
var ip = drupalSettings.greatesthits.ip;

(function (Drupal, $) {
  $.ajax({url: '/greatesthits?url=' + url + '&type=' + type + '&ip=' + ip});
})(Drupal, jQuery);
