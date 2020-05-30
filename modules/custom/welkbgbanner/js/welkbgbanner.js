 var vid = document.getElementById("bgvid");
 var sound = document.getElementById("sound");
 var inspirevid = document.getElementById("inspirevid");
 //inspirevid.pause(); // Inspire your stay video

// Implement function makeSound for background
function makeSound() { 
 if(vid.muted){
	vid.muted = false;	
	sound.classList.remove("off");
	sound.classList.add("on");
 }
 else{
	vid.muted = true;	
	sound.classList.remove("on");
	sound.classList.add("off");
 }
}
// Javascript for video sound on and off
function soundonoffVideo(e) {
  var video = $(e.target).closest('.group').find('video')[0];
	var btnSound = $(e.target).closest('.group').find('button')[0];
  if (video.muted) {
        video.muted = false;		
		btnSound.classList.remove("off");
		 btnSound.classList.add("on");
  } else {
		video.muted = true;
		btnSound.classList.remove("on");
		 btnSound.classList.add("off");
	}
}
$(".sound_button").find('button').click(soundonoffVideo);
// Javascript for video play and pause
function playVideo(e) {
  var video = $(e.target).closest('.group').find('video')[0];
  var btnPlay = $(e.target).closest('.group').find('button')[1];
	//alert(video);return false;
  if (video.paused) {
	  video.play();
		  btnPlay.classList.remove("play");
		  btnPlay.classList.add("pauseplay");
	} else {
	  video.pause();		
	  btnPlay.classList.remove("pauseplay");
	  btnPlay.classList.add("play");
	  }

}
$(".play_button").find('button').click(playVideo);
// Javascript for video play and pause on Inspire section of Amenities & Activities section
function inspireplayVideo(e) {
	var video = $(e.target).closest('.group').find('video')[0];
	var btnPlay = $(e.target).closest('.group').find('button')[0];
	  // alert(btnPlay);return false;
	if (video.paused) {
	  video.play();
	  video.muted = false;
		  btnPlay.classList.remove("play");
		  btnPlay.classList.add("paused");
	} else {
	  video.pause();
	  video.muted = true;		
	  btnPlay.classList.remove("paused");
	  btnPlay.classList.add("play");
	  }
  
  }
  $(".inspire_button").find('button').click(inspireplayVideo);
  // Pause video/ Sound off background video when click on View Gallery button.
  $('.home-banner-text').find('a').on('click', function () {
	$('#bgvid').prop('muted', true);
	$('#sound').removeClass('on');
  });