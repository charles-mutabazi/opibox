<script>
    //Sign in with Facebook
    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            // * here we login to the application
            testAPI();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            document.getElementById('status').innerHTML = 'Please log ' +
            'into Facebook.';
            // render2();
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    // function checkLoginState() {
    //     FB.getLoginStatus(function(response) {
    // 		statusChangeCallback(response);
    //     });
    // }

    window.fbAsyncInit = function () {
        FB.init({
            appId: '962007023840185',
            cookie: true,  // enable cookies to allow the server to access
            // the session
            xfbml: true,  // parse social plugins on this page
            version: 'v2.2' // use version 2.2
        });

        // Now that we've initialized the JavaScript SDK, we call
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        //i commented this out so as to not automaticlly log in
        //   FB.getLoginStatus(function(response) {
        // statusChangeCallback(response);
        //   });

    };

    // Load the SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function (response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';

            console.log(response);

            var email = response.email;
            var first_name = response.first_name;
            var last_name = response.last_name;
            var username = response.name;
            var facebook_id = response.id;
            var social = 'facebook';

            //*login the user
            $.ajax({
                type: "POST",
                url: "login/ajax_login", //path to login. ajax_login method in laogin controller
                data: {
                    email: email,
                    first_name: first_name,
                    last_name: last_name,
                    username: username,
                    social: social,
                    facebook_id: facebook_id
                }, //send the email as the post request
                dataType: "text",
                cache: false,
                success: function (data) {
                    console.log(data); //as a debugging message.
                    window.location.replace("home"); // redirect user to homepage

                }

            });

        });
        //end test API
    }

    console.log('fblogin-working');

    // use this functon for the conlick button
    function fb_login() {
        FB.login(function (response) {
            if (response.authResponse) {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function (response) {
                    console.log('Good to see you, ' + response.name + '.');
                    testAPI();//send data to ajax login controller
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'public_profile,email'});
    }

    //run this function
    //if logged in the person will redirected to the home page.
    //checkLoginState();


</script>