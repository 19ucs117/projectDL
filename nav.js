$(document).ready(function(e) {
  $('.sub-menu').click(function(){
    $(this).toggleClass('tab');
  });

  $('.btn').click(function(){
    $(this).toggleClass('click');
    $('.main-nav').toggleClass('show');
  });
  
  $('.herfMenu').click(function(){    
    $('.main-nav').toggleClass('show');
  });

  $("#editProfile").click(function(){
    $(".Home").html("<p>EditProfile</p>");
  });

  $("#Home").click(function(){
    $(".Home").html("<p>Home</p>");
  });

  $("#ResourceSubmissionF1").click(function(){
    $(".Home").html("<p>ResourceSubmissionF1</p>");
  });

  $("#ResourceSubmissionF2").click(function(){
    $(".Home").html("<p>ResourceSubmissionF2</p>");
  });

  $("#ResourceEdit").click(function(){
    $(".Home").html("<p>ResourceEdit</p>");
  });

  $("#NewArrivals").click(function(){
    $(".Home").html("<p>NewArrivals</p>");
  });

  $("#AdvancedSearch").click(function(){
    $(".Home").html("<p>AdvancedSearch</p>");
  });

  $("#SimpleSearch").click(function(){
    $(".Home").html("<p>SimpleSearch</p>");
  });

  $("#JournalsEntry").click(function(){
    $(".Home").html("<p>JournalEntry</p>");
  });

  $("#JournalSearch").click(function(){
    $(".Home").html("<p>JournalSearch</p>");
  });

  $("#JournalsUpdate").click(function(){
    $(".Home").html("<p>JournalUpdate</p>");
  });

  $("#PublicWebsitesEntry").click(function(){
    $(".Home").html("<p>PublicWebsitesEntry</p>");
  });
  
  $("#PublicWebsitesSearch").click(function(){
    $(".Home").html("<p>PublicWebsitesSearch</p>");
  });

  $("#PublicWebsitesUpdate").click(function(){
    $(".Home").html("<p>PublicWebsitesUpdate</p>");
  });

  $("#Search").click(function(){
    $(".Home").html("<p>Search</p>");
  });

  $("#DatabaseWebsitesEntry").click(function(){
    $(".Home").html("<p>DatabaseWebsitesEntry</p>");
  });

  $("#DatabaseSearch").click(function(){
    $(".Home").html("<p>DatabaseSearch</p>");
  });

  $("#DatabaseWebsitesUpdate").click(function(){
    $(".Home").html("<p>DatabaseWebsitesUpdate</p>");
  });

  $("#NewUserApproval").click(function(){
    $(".Home").html("<p>NewUserApproval</p>");
  });
  
  $("#UserUpdate").click(function(){
    $(".Home").html("<p>UserUpdate</p>");
  });

  $("#UserDelete").click(function(){
    $(".Home").html("<p>UserDelete</p>");
  });  

  $("#DomainCreation").click(function(){
    $(".Home").html("<p>DomainCreation</p>");
  });

  $("#DomainUpdate").click(function(){
    $(".Home").html("<p>DomainUpdate</p>");
  });  

  $("#CollectionCreation").click(function(){
    $(".Home").html("<p>CollectionCreation</p>");
  });

  $("#CollectionUpdate").click(function(){
    $(".Home").html("<p>CollectionUpdate</p>");
  });

  $("#NewEntryApproval").click(function(){
    $(".Home").html("<p>NewEntryApproval</p>");
  });

  $("#ResourceSubmission").click(function(){
    $(".Home").html("<p>ResourceSubmission</p>");
  });

  $("#DocumentDelete").click(function(){
    $(".Home").html("<p>DocumentDelete</p>");
  });

  $("#DocumentUpdate").click(function(){
    $(".Home").html("<p>DocumentUpdate</p>");
  });

});
