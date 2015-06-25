<script>

    function mission(){
        alert("Cows");
    }
    /* Executed when the APIs finish loading */
    function render() {
        console.log("render function initiated");
        // Additional params including the callback, the rest of the params will
        // come from the page-level configuration.
        var additionalParams = {
            'callback': signinCallback
        };

        // Attach a click listener to a button to trigger the flow.
        var signinButton = document.getElementById('signinButton');
        signinButton.addEventListener('click', function() {
            gapi.auth.signIn(additionalParams); // Will use page level configuration
        });
    }

    function render2() {
        console.log("render function initiated");
        // Additional params including the callback, the rest of the params will
        // come from the page-level configuration.
        var additionalParams = {
            'callback': signinCallback
        };

        // Attach a click listener to a button to trigger the flow.
        // var signinButton = document.getElementById('signinButton');
        // 	signinButton.addEventListener('click', function() {
        gapi.auth.signIn(additionalParams); // Will use page level configuration
        // });
    }

    function signinCallback(authResult) {
        if (authResult['status']['signed_in']) {
            console.log("signed in g+");
            // Update the app to reflect a signed in user
            // Hide the sign-in button now that the user is authorized, for example:

            //declare the varrables
            //this is the users profile info
            var ma;
            var familyName;
            var givenName;
            var url;
            var social;

            gapi.client.load('plus','v1', function(){
                //make API calls
                var request = gapi.client.plus.people.get({
                    'userId' : 'me'
                });

                request.execute(function(resp) {
                    console.log('ID: ' + resp.id);
                    console.log('Display Name: ' + resp.displayName);
                    console.log('Image URL: ' + resp.image.url);
                    console.log('Profile URL: ' + resp.url);
                    console.log('familyName: ' + resp.name.familyName);
                    console.log('givenName: ' + resp.name.givenName);
                    console.log(resp);

                    familyName  =resp.name.familyName;
                    givenName   =resp.name.givenName;
                    profileUrl  =resp.url;
                    displayName =resp.displayName;
                    social      ='google+';

                    //window.location.replace("home");

                    //*login or register user
                    $.ajax({
                        type: "POST",
                        url: "login/ajax_login", //path to login. ajax_login method in laogin controller
                        data: {displayName:displayName,familyName:familyName,givenName:givenName,profileUrl:profileUrl,social:social}, //data to be sent
                        dataType: "text",
                        cache:false,
                        success:
                            function(data){
                                console.log(data); //as a debugging message.
                                window.location.replace("home"); // redirect user to homepage

                            }
                        //end ajaxlogin
                    });
                });
            });

            document.getElementById('signinButton').setAttribute('style', 'display: none');
        } else {
            // Update the app to reflect a signed out user
            // Possible error values:
            //   "user_signed_out" - User is signed-out
            //   "access_denied" - User denied access to your app
            //   "immediate_failed" - Could not automatically log in the user
            console.log('Sign-in state: ' + authResult['error']);
        }
    }

    // initiate the render function
    render();
</script>