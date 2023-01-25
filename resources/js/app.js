require('./bootstrap');
require('admin-lte');

$("#show-restocked-items").click(function() {
    $("#restocked-items-modal").show();
});
$("#close-modal").click(function() {
    $("#restocked-items-modal").hide();
});
