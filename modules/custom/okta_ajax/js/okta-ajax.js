window.clearOktaSession = function(){
    window.sessionStorage.removeItem('okta_session');
    oktaSelfApi('logout',{},{}, function(res) {
      window.location.href=window.oktaAccountPath;
    });
    
  };
  
  function updateOktaOrg() {
    var new_street = document.getElementById('updateOktaStreetAddress').value;
    var new_phone = document.getElementById('updateOktaPrimaryPhone').value;
    var token = window.sessionStorage.getItem('okta_session');
    var xhttp = new XMLHttpRequest();
    var url = document.URL.substr(0,document.URL.lastIndexOf('/'))+'/okta/update_profile';
    xhttp.open("POST",url,true);
    xhttp.onreadystatechange=function(){
      if(xhttp.readyState==4){
          if(xhttp.status!=200){
              alert("Updated Request returned error code "+xhttp.status);
          } else {
          alert("Updated org.. loading user details");
          document.querySelector('#okta_ajax_loggedin div.user_details').innerHTML = "<h4>User Details</h4><pre style='width:500px;height:200px;overflow:scroll;'>"+JSON.stringify(JSON.parse(xhttp.response),undefined,4)+"</pre>";
  
          }
           }
    };
    var data = new FormData();
    data.append("token",token); data.append("streetAddress",new_street);
    data.append("primaryPhone", new_phone);
    xhttp.send(data);
  }
  
window.getOktaUser = function(cb){
    var token = window.sessionStorage.getItem('okta_session');
    var xhttp = new XMLHttpRequest();
    var url = (window.oktaFrontURL?window.frontURL:document.URL.substr(0,document.URL.lastIndexOf('/'))+'/' )+'okta/update_profile';
    xhttp.open("POST",url,true);
    xhttp.onreadystatechange=function(){
      if(xhttp.readyState==4&&xhttp.status==200) {
        var user = JSON.parse(xhttp.response);
        if(cb){ cb(user); }
        //if(user && user['profile'] && user['profile']['primaryPhone'] ) { document.getElementById('updateOktaPrimaryPhone').value=user['profile']['primaryPhone']; }
        //if(user && user['profile'] && user['profile']['streetAddress'] ) { document.getElementById('updateOktaStreetAddress').value=user['profile']['streetAddress']; }
        //document.querySelector('#okta_ajax_loggedin div.user_details').innerHTML = "<h4>User Details</h4><pre style='width:500px;height:300px;overflow:scroll;'>"+JSON.stringify(JSON.parse(xhttp.response),undefined,4)+"</pre>";
       }
    };
    var data = new FormData(); data.append("token",token);
    xhttp.send(data);
  };
  
window.JSON_to_URLEncoded = function(element,key,list){
  var list = list || [];
  if(typeof(element)=='object'){
    for (var idx in element)
      JSON_to_URLEncoded(element[idx],key?key+'['+idx+']':idx,list);
  } else {
    list.push(key+'='+encodeURIComponent(element));
  }
  return list.join('&');
};
  
window.oktaSelfApi = function( endpoint, data, headers, cb ) {
    var xhttp = new XMLHttpRequest();
    var url = (window.oktaFrontURL?window.oktaFrontURL : document.URL.substr(0,document.URL.lastIndexOf('/')) + '/' ) ;
    url = document.URL.substr(0,document.URL.lastIndexOf('/')) + '/' ;
    url =  url +'okta/'+endpoint; //for self api call drupal hook 
    console.log( window.oktaFrontURL, url );
    xhttp.open("POST", url, true);
    if(headers && typeof(headers)=="object" ) {
     for(var key in headers){
       xhttp.setRequestHeader(key,headers[key]);
     }
    }
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState==4 ) { cb(xhttp); }
    };
    if(typeof(data) == "object") {
     if(headers && headers['Content-Type'] == 'application/x-www-form-urlencoded' ) {
      data = JSON_to_URLEncoded(data);
     }  else {
      let newD = new FormData();
      for(var key in data) {
        newD.append(key, data[key]);
      }
      data = newD;
     }
    }
    xhttp.send(data);
  };

function updateLoginButton(){
    if(window.sessionStorage.getItem('okta_session')){
      if( document.querySelector('.menu .utility-nav > a:nth-child(3)') ) {
        document.querySelector('.menu .utility-nav > a:nth-child(3)').innerHTML="My Profile";
      }
      var signOutA = document.createElement("a");
      if ( Array.from(document.querySelectorAll('a.nav-link'))
            .find(el => el.textContent === 'Sign In') ) {
        signOutA = Array.from(document.querySelectorAll('a.nav-link'))
            .find(el => el.textContent === 'Sign In');
      } else if( document.querySelector('nav.navbar a.sign-in') ) {
        signOutA = document.querySelector('nav.navbar a.sign-in');
      } else {
        signOutA.className = "nav-lank"; signOutA.id ="sign-out-nav-link";
      }
      signOutA.innerText="Sign Out";
      signOutA.href = "#";
      signOutA.addEventListener('click',function(o){ 
        if(window._oktaIsLoggingOut) return;
        window._oktaIsLoggingOut=true;
        window.sessionStorage.removeItem("okta_session");
        window.sessionStorage.removeItem("okta_user");
        window.sessionStorage.removeItem("okta_state");
        oktaSelfApi('logout',{},{},function(){
          window._oktaIsLoggingOut=false;
          document.location.href=(window.oktaFrontURL?window.frontURL:document.URL.substr(0,document.URL.lastIndexOf('/'))+'/') + "account";
        });
        return false;
       });
      if( !document.querySelector('nav.navbar a.sign-in') && document.querySelector('.menu .utility-nav > a:nth-child(3)') ) {
        document.querySelector('.menu .utility-nav > a:nth-child(3)').insertAdjacentElement("afterend",signOutA);
      }
    } else if( document.querySelector('nav.navbar a.sign-in') ) {
      document.querySelector('nav.navbar a.sign-in').href = (window.oktaFrontURL?window.oktaFrontURL:document.URL.substr(0,document.URL.lastIndexOf('/'))+'/') + "account";
    }
}
updateLoginButton(); updateLoginButton();

