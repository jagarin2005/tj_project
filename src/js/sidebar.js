$(document).ready( function () {
  $('#toggleSidebar').click( 
    function (e) { 
      e.preventDefault();
      $("#main").toggleClass("col-md-10");
      $("#sidebar").toggleClass("col-md-2");
      
    }
  )
});
