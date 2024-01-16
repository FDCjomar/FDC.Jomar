$(document).ready(function() {
    $('#register-form').submit(function(event) {
        event.preventDefault();
       console.log('Submitted');
    });
    console.log('hello');
});