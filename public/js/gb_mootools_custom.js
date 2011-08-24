/*
---

name: GB MooTools Custom

description: Custom code to implement MooTools within the pages of BigDDRMusiProRemCo ( bigdaddydeathray.com )

license: MIT-style license.

copyright: Copyright (c) 2011 Daniel Sheppard <danielsheppard@veryboring.net>

author: Daniel Sheppard <danielsheppard@veryboring.net>

...
*/

//first on the list is to load page components in a snazzy manner

// accordion opening for the header and fade in sub-components

window.addEvent('domready', function(){

    var header = $('header');
    header.set('morph', {
        duration: 1000
      });
    header.morph({
        'height': '130px;'
      });

      var navigation = $('header-navigation');
      navigation.set('morph', {
        duration: 1200
      });
      navigation.morph({
        'opacity': '1;'
        });

    var login = $('header-login');
    login.set('morph', {
        duration: 1400
      });
    login.morph({
        'opacity': '1;'
    });
    var logo = $('header-logo');
    logo.set('morph', {
        duration: 1400
      });
    logo.morph({
        'opacity': '1;'
    });

// END HEADER STUFF

// BEGIN AJAX/JSON TRANSACTION HANDLERS
/*
  $('save').addEvent('click', function(e){
    e.stop();

    var request = new Request.JSON({

      url: '/user/edituser/',

      onRequest: function(){
        gallery.set('text', 'Loading...');
      },

      onComplete: function(jsonObj) {
        var reply = JSON.decode(jsonObj);
        alert(reply);
      },

      data: { json: JSON.encode(data) }

    }).send();
  });
*/





});