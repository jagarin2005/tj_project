$(document).ready( function () {
  $('#toggleSidebar').click( 
    function (e) { 
      e.preventDefault();
      $("#sidebar").toggleClass("col-md-2");
      $("#main").toggleClass("col-md-10");
    }
  )
});
