<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{2104492132906302}',
      cookie     : true,
      xfbml      : true,
      version    : '{3.2}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>



// Check login status

FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});

// Response

{
    status: 'connected',
    authResponse: {
        accessToken: '...',
        expiresIn:'...',
        signedRequest:'...',
        userID:'...'
    }
}

/*
status specifies the login status of the person using the app. The status can be one of the following:
    - connected - the person is logged into Facebook, and has logged into your app.
    - not_authorized - the person is logged into Facebook, but has not logged into your app.
    - unknown - the person is not logged into Facebook, so you don't know if they've logged into your app or FB.logout() was called before and therefore, it cannot connect to Facebook.
    - authResponse is included if the status is connected and is made up of the following:
    - accessToken - contains an access token for the person using the app.
    - expiresIn - indicates the UNIX time when the token expires and needs to be renewed.
    - signedRequest - a signed parameter that contains information about the person using the app.
    - userID - the ID of the person using the app.
*/