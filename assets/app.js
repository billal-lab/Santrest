/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import $ from "jquery";

$(".custom-file-input").on("change", function (e) { //jquery
    var inputFile = e.currentTarget;
    $(inputFile)
        .parent()
        .find(".custom-file-label")
        .html(inputFile.files[0].name);
    
});

// $(".navbar").on("click", function (e) {
//     alert("jquery effects");
    
// });

document.getElementById("delete").addEventListener("click", function (e){ //javascript
    e.preventDefault();
    confirm('Are you sure ?') && document.getElementById('js-sant-delete-form').submit();
});

// document.getElementById("logout").addEventListener("click", function (e){ //javascript
//     e.preventDefault();
//     document.getElementById('js-logout-form').submit();
// });
// $( ".navbar" ).hover(
//     function() {
//       alert("message");
//     }
// );
