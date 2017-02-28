<?php

/* By Qassim Hassan, http://wp-time.com/send-email-via-gmail-api-using-php/ */

$scope = "https://mail.google.com/"; // Do not change it!

$redirect_uri = "http://localhost/eshopp/admin/sign-in.php"; // Enter your redirect_uri

$client_id = "145622862755-sh59uf74jhpt3rtlrm588umffrm2a4ad.apps.googleusercontent.com"; // Enter your client_id

$client_secret = "-ayuoPNlVtzPbNjYJg-Zntu_"; // Enter your client_secret

$login_url = "https://accounts.google.com/o/oauth2/v2/auth?scope=$scope&response_type=code&redirect_uri=$redirect_uri&client_id=$client_id"; // Do not change it!

?>