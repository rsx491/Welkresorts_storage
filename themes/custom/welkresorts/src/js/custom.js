$(function () {
  // Sidebar Menu Mobile view
  $('.validation-msg').hide();
  var totalWidth = $("body").outerWidth();
  $(".navbar-collapse").css("left", -totalWidth);
  $(".we-mega-menu-submenu").css("right", -totalWidth);
  $(".we-mega-menu-submenu").hide();
  $(".navbar-toggler-icon").on("click", function () {
    $(".navbar-collapse").removeClass("hidden");
    $(".navbar").removeClass("m-view");
    if (!$(".navbar-collapse").hasClass("show")) {
      $(this).addClass("hidden");
      $(".navbar").addClass("m-view");
      $(".close-btn").toggleClass("hidden");
    }

    $(".navbar-collapse").animate({
      left: "0px"
    },
      100
    );
  });
  $(".we-mega-menu-ul")
    .find("li.dropdown-menu")
    .on("click", function () {
      $(".we-mega-menu-submenu").css("right", -totalWidth);
      $(".we-mega-menu-submenu").removeClass("hidden");
      if ($(".navbar-collapse").hasClass("show")) {
        $(".we-mega-menu-submenu").animate({
          right: "0px"
        },
          500
        );
      } else {
        $(this).toggleClass("active");
        $("header,body").toggleClass("active");
      }
    });

  $(".btn.back").on("click", function (event) {
    event.preventDefault();
    event.stopPropagation();
    $(".we-mega-menu-submenu").animate({
      right: totalWidth
    },
      100
    );
  });

  // Close Button
  $(".close-btn").on("click", function () {
    $(".navbar-collapse").animate({
      left: -totalWidth
    },
      300
    );
    $(".we-mega-menu-submenu").addClass("hidden");
    $(".navbar-toggler-icon").removeClass("hidden");
    $(".close-btn").addClass("hidden");
  });

  // Accordion Default Select
  $("#accordion .field--item")
    .first()
    .find(".card-header")
    .addClass("active");
  $("#accordion .field--item")
    .first()
    .find(".card-header")
    .next()
    .addClass("show");

  var cardlength = $("#accordion > .field > .field--item").length;

  var counter = 1;

  $("#accordion")
    .find(".card")
    .each(function () {
      $(this)
        .find(".card-header")
        .find("button")
        .attr("data-target", "#collapse" + counter);
      $(this)
        .find(".card-header")
        .next()
        .attr("id", "collapse" + counter);
      counter++;
    });

  $("#accordion .card-header")
    .find("button")
    .on("click", function () {
      $(".card")
        .find(".card-header")
        .removeClass("active");
      var selector = $(this)
        .parents(".card-header")
        .next();
      if (!selector.hasClass("show")) {
        $(this)
          .parents(".card-header")
          .addClass("active");
      }
    });



  $('.overview-gallery').find('.zoom').on('click', function () {
    $('#imagepreview').attr('src', $(this).parent().find('img').attr('src'));
  });
  // Fixed Header
  $(window).scroll(function () {
    var sticky = $("header"),
      stickyNav = $('.categories-block');

    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
      sticky.addClass("fixed");
    } else {
      sticky.removeClass("fixed");
    }
    if (scroll >= 816) {
      $('.categories-block').addClass('fixed');
      $('header').addClass('fixed-cat');
    } else {
      $('.categories-block').removeClass('fixed');
      $('header').removeClass('fixed-cat');

    }
    $(".sticky-top-btn,.back-top").on("click", function () {
      var body = $("html, body");
      body.stop().animate({ scrollTop: 0 }, 1000, 'swing');
    });

  });

  //Initialize Date Range Picker
  var $button = $('.check-in-out .select-side .arrow-down');
  var $input = $(".check-in-out input[name='check_in_check_out']");
  //$input.attr('data-date-container', '#datePickerContainer')
  var addDays = 60; // Days you want to add for future
  var nextDay = 1;
  var today = new Date(); // today date
  var tommorow = new Date(today.getTime() + (nextDay * 24 * 60 * 60 * 1000)); // future date  
  var defaultRange = today.toLocaleDateString().substring(0, 10) + ' ' + '-' + ' ' + tommorow.toLocaleDateString().substring(0, 10);
  $input.val(defaultRange);
  $input.datepick({
    minDate: new Date(),
    dateFormat: 'mm/dd/yyyy',
    monthsToShow: 2,
    rangeSelect: true, // Allows for selecting a date range on one date picker 
    rangeSeparator: ' - ', // Text between two dates in a range     
    prevText: '<',
    nextText: '>',
    changeMonth: false,
    selectDefaultDate: true,
    onDate: getResortPrice,
    showTrigger: '#calendarBtn',
    showAnim: 'slideDown',
    popupContainer: '.datePickerContainer',
    alignment: 'bottom',
    showOnFocus: false
  });

  function getResortPrice(date) {
    var dt = date.getDate() > 9 ? date.getDate() : "0" + date.getDate();
    var month = date.getMonth() + 1;
    var mont = month > 9 ? month : "0" + month;
    var dateVal = date.getFullYear() + "-" + mont + "-" + dt;
    for (var i = 0; i < datePriceArray.length; i++) {
      if (datePriceArray[i].date == dateVal) {
        return { content: date.getDate() + '<div class="h-prices">' + "$" + datePriceArray[i].rate.minRate + '</div>' }
      }
    }
    return { content: date.getDate() + '<div>&nbsp;</div>' }
  }

  var specificPrice = {};
  var datePriceArray = [];

  function getPriceApi(rooms, guests, hotelCode) {
    var hotelCode = hotelCode;
    var checkIn = new Date(); // today date
    var checkOut = new Date(today.getTime() + (60 * 24 * 60 * 60 * 1000));
    var path = drupalSettings.path.baseUrl;
    var baseurl = window.location.origin;
    var base_path = baseurl + path;
    if (hotelCode == '' || hotelCode == null) {
      var hotelCode = 99939;
    }
    $.ajax({
      url: base_path + '/calendar/hotelcode',
      type: 'GET',
      headers: {
        'content-type': 'application/json'
      },
      dataType: "json",
      cache: false,
      data: {
        'hotelCode': hotelCode,
        'dateIn': checkIn.toISOString().substring(0, 10),
        'dateOut': checkOut.toISOString().substring(0, 10),
        'rooms': rooms,
        'adults': guests
      },
      success: function (res) {
        datePriceArray = res.dates || [];
        $('#loader-spin').hide('slow');
      },
      error: function (xhr, status, error) {        
        alert('Error - ' + xhr.statusText);
        $('#loader-spin').hide('slow');
      }
    });
  }
  $('.booking-slots .discover-resort').find('.resort-name').on('click', function () {
    var hotelCode = $(this).attr('htc');
    $('#loader-spin').show('fast');
    getPriceApi(1, 2, hotelCode);
  });

  $(".check-in-out input[name='check_in_check_out']").attr('readonly', 'readonly');

  // Book your Stay Toggle Popup
  $(".booking-slots .select-side").removeClass('active');
  function toggleBookingSlot($this, selector) {
    if ($this.parent().hasClass("destination")) {
      $this.toggleClass('active');
      $(selector).find(".dropdown-menu.popup").slideToggle();
      $(selector).find(".datepick-popup").slideUp();
      $(selector).find(".dropdown-menu.rooms").slideUp();
      $this.parent().siblings().find('.select-side').removeClass('active');
    } else if ($this.parents().hasClass("check-in-out")) {
      $this.toggleClass('active');
      $(selector).find(".dropdown-menu.rooms").slideUp();
      $(selector).find(".dropdown-menu.popup").slideUp();
      $this.parents('.check-in-out').siblings().find('.select-side').removeClass('active');
    } else if ($this.parent().hasClass("rooms-booking")) {
      $this.toggleClass('active');
      $(selector).find(".dropdown-menu.rooms").slideToggle();
      $(selector).find(".dropdown-menu.popup").slideUp();
      $(selector).find(".datepick-popup").slideUp();
      $this.parent().siblings().find('.select-side').removeClass('active');
    } else {
      $this.removeClass("active");
    }
  }

  $('.booking-slots.header').find('.select-side').on('click', function () {
    var $this = $(this);
    toggleBookingSlot($this, '.booking-slots.header');
  });
  $('.content-wrapper .booking-slots').find('.select-side').on('click', function () {
    var $this = $(this);
    toggleBookingSlot($this, '.content-wrapper .booking-slots');
  });



  //Default Resort Select
  var defaultTextHome = 'Select a resort';
  var defaultText = $("form select[name='destinations'] option:selected").text();
  if ($('body').is('.path-frontpage, .page-node-type-blog, .path-blogs, .page-node-type-welk-experience,.page-node-type-work-with-us,.page-node-type-tours,.page-node-type-media-landing-page')) {
    $("input[name='resort_destinations']").each(function () {
      $(this).val(defaultTextHome);
    })
  } else {
    $("input[name='resort_destinations']").val(defaultText);
  }

  $(".webform-submission-booking-form-form .dropdown-menu")
    .find(".resort-name")
    .on("click", function () {
      var selectedResort = $(this).text();
      var selectedId = $(this).attr("id");
      var id = $(this).attr('href');

      $(".form-item-resort-destinations input[name='resort_destinations']").val(selectedResort);
      $("#edit-destinations option").each(function () {
        if ($(this).val() == selectedId) {
          $(this).attr("selected", "selected");
        }
        if ($(this).val() == id) {
          $(this).attr("selected", "selected");
        }
      });
      $(".dropdown-menu.popup").slideUp("slow");
    });

  $(".webform-submission-booking-form-form").find('input[type="text"]').prop('readonly', true);
  $(".webform-submission-booking-form-form").find('input[name="promo_code"]').prop('readonly', false);

  // Secondary Nav
  var dropDownChk = $(".secondary-nav").find("li");
  dropDownChk.each(function () {
    if ($(this).children("ul").length == 1) {
      $('<i class="arrow"></i>').appendTo($(this).find("> a"));
    }
  });

  // Explore Resort
  toggleNav('.sub-pages-header .explore-resort-btn', '.secondary-nav');

  // Room Booking
  var totalRooms = 1;
  var maxCount = 6;
  var maxGuest = 8;
  var totalGuests = 2;

  $('.booking-div').find('a.btn-primary').click(function () {
    totalRooms = $(".rooms-guests.guest.show").length;
  });
  $(".edit-rooms-guests").val(totalRooms + " " + "Rooms:" + "  " + totalGuests + " " + "Guests");
  $('.webform-submission-form').find('input[name="rooms"]').val(totalRooms);
  $('.webform-submission-form').find('input[name="guests"]').val(totalGuests);
  function roomGuestCounter($this) {
    var oldValue = $this.parent().find("input").val();
    if ($this.parents(".rooms-guests").hasClass("total-rooms")) {
      $this.removeClass('active');
      if (parseInt(oldValue) < maxCount) {
        if ($this.hasClass("add")) {
          var newVal = parseInt(oldValue) + 1;
          $(".rooms-guests:nth-child(" + (newVal + 1) + ")").removeClass("hide");
          $(".rooms-guests:nth-child(" + (newVal + 1) + ")").addClass("show");
        } else {
          if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
            $(".rooms-guests:nth-child(" + (newVal + 2) + ")").addClass("hide");
            $(".rooms-guests:nth-child(" + (newVal + 2) + ")").removeClass("show");
          } else {
            newVal = 1;
          }
        }
      } else {
        newVal = oldValue;
        if ($this.hasClass("minus")) {
          var newVal = parseFloat(oldValue) - 1;
          $(".rooms-guests:nth-child(" + (newVal + 2) + ")").addClass("hide");
          $(".rooms-guests:nth-child(" + (newVal + 2) + ")").removeClass("show");
        }
        oldValue = newVal;
      }
      $this
        .parent()
        .find("input")
        .val(newVal);
      totalRooms = newVal;
    } else {
      if (parseInt(oldValue) < maxGuest) {
        if ($this.hasClass("add")) {
          var newVal = parseInt(oldValue) + 1;
        } else {
          if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 1;
          }
        }
      } else {
        newVal = oldValue;
        if ($this.hasClass("minus")) {
          var newVal = parseFloat(oldValue) - 1;
        }
        oldValue = newVal;
      }
      $this
        .parent()
        .find("input")
        .val(newVal);
    }
  }

  $('.booking-slots.header').find('.rooms-guests button').on('click', function () {
    $this = $(this);
    var headerGuestArray = [];
    roomGuestCounter($this);
    var guestsCount = 0;
    $('.booking-slots.header').find(".rooms-guests.guest")
      .each(function () {
        if ($(this).hasClass("show")) {
          var guestsNo = $(this).find('input[type="text"]');
          headerGuestArray.push(guestsNo.val());
          guestsCount += parseInt(guestsNo.val());
          totalGuests = guestsCount;
        }
      });
    $(".edit-rooms-guests").val(totalRooms + " " + "Rooms:" + "  " + totalGuests + " " + "Guests");
    $('.webform-submission-form').find('input[name="rooms"]').val(totalRooms);
    $('.webform-submission-form').find('input[name="guests"]').val(headerGuestArray);
    getPriceApi(totalRooms, totalGuests);
  });
  $('.content-wrapper .booking-slots').find('.rooms-guests button').on('click', function () {
    $this = $(this);
    roomGuestCounter($this);
    var guestsCount = 0;
    var contentGuestArray = [];
    $('.content-wrapper .booking-slots').find(".rooms-guests.guest")
      .each(function () {
        if ($(this).hasClass("show")) {
          var guestsNo = $(this).find('input[type="text"]');
          contentGuestArray.push(guestsNo.val());
          guestsCount += parseInt(guestsNo.val());
          totalGuests = guestsCount;
        }
      });
    $(".edit-rooms-guests").val(totalRooms + " " + "Rooms:" + "  " + totalGuests + " " + "Guests");
    $('.booking-slots.header').find('.rooms-guests.total-rooms').find('input').val(totalRooms);
    $('.webform-submission-form').find('input[name="rooms"]').val(totalRooms);
    $('.webform-submission-form').find('input[name="guests"]').val(contentGuestArray);
    getPriceApi(totalRooms, totalGuests);
  });

  // Banner/Video Display & Video Pause & Play
  var player = $('#bgvid');
  $(".video-btn-wrapper .btn.pauseplay").click(function () {
    if (player.get(0).play() && !$(this).hasClass('play')) {
      $(this).addClass('play');
      player.get(0).pause();
    } else {
      $(this).removeClass('play');
      player.get(0).play();
    }
  });

  if ($(".video-banner-wrapper").find("#bgvid").length == 1) {
    $("#heroBanner").hide();
    $(".video-banner-wrapper").find("#bgvid").show();
    $(".video-banner-wrapper").css("max-height", "758px");
    $(".video-banner-wrapper").addClass("active");
  }

  //Mega Menu Link Opening issue
  $('.we-mega-menu-submenu a').on('click ', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    window.open(url, '_self');
  });

  // View More / Less
  function defaultChar(element, maxCount) {
    $(element).each(function () {
      var text = $(this).find('.main-content').text().trim();
      var word = "";
      var count = 0;
      var index = 0;
      for (var i = 0; i < text.length; i++) {
        if (text[i] == ' ' || text[i] == ',' || text[i] == '.') {
          if (word.trim() != "") { // if we actually have a word (this avoids multiple white spaces)
            count++;
            word = "";
            index = i;
            if (count == maxCount) break;
          }
        } else {
          word += text[i];
        }
      }
      text = $(this).find('.main-content').html();
      if (count == maxCount && index + 1 != text.length) {
        html = '<span class="default-text">' + text.substring(0, index) + '</span>';
        $(this).find('.main-content').html(html);
        $('<span class="morecontent"> ' + text + '</span>').appendTo($(this).find('.main-content'));
        $(this).find('a.viewmore').show();
      } else {
        $(this).find('a.viewmore').hide();
        $(this).find('a.viewmore.medium').show();
      }
      $(this).find('.morecontent').hide();
    });

    $(element).each(function () {
      $(this).find('a.viewmore').click(function (event) {
        event.preventDefault();
        var pageResort = $('body').hasClass('page-node-type-resort-destinations'),
          pageRoomDetails = $('body').hasClass('page-node-type-room-details'),
          pageOfffer = $('body').hasClass('page-node-type-offers'),
          pageWorkWithUs = $('body').hasClass('page-node-type-work-with-us');

        $(this).removeClass('active');
        $(this).parent().prev().find('.default-text').show('fast');
        $(this).parent().prev().find('.morecontent').slideToggle('fast').toggleClass('active');

        if ($(this).parent().prev().find('.morecontent').hasClass('active')) {
          if (pageResort || pageRoomDetails || pageOfffer || pageWorkWithUs) {
            $(this).addClass('active');
            $(this).parent().prev().find('.default-text').hide('fast');
            $(this).find('span').text('View Less');
          }
        } else {
          $(this).find('span').text('View More');
          $(this).removeClass('active');
        }
      });
    });

  }
  defaultChar('.page-node-type-amenities-activities .activities', '100');
  defaultChar('.family-resort', '25');
  defaultChar('.welk-experience', '100');
  defaultChar('.col-7-3-style', '100');
  defaultChar('.user-experience .col-lg-4', '10');
  defaultChar('.offer-component', '40');
  //Location Map Outdoor Activities
  $('.local-map-area .title-block,#locationMap .title-block').find('.icon').on('click', function () {
    $(this).parent().next('ul').slideToggle();
  });
  $('#viewGallery,#tourGallery').on('hidden.bs.modal', function () {
    if ($('#pvid').prop('muted', false)) {
      $('#pvid').prop('muted', true);
      $('#popupsound').removeClass('on');
    } else {
      $('#pvid').prop('muted', false);
      $('#popupsound').addClass('on');
    }
  });
  //Jump Nav
  toggleNav('.jump-nav', '.mobile-tab .nav-tabs');
  //Slide Toggle
  function toggleNav(elementselect, targetelement) {
    $(elementselect).on('click', function () {
      $(targetelement).slideToggle("slow");
      $(elementselect).toggleClass("active");
    });
  }
  $('#heroBanner .carousel-item:first,#viewGallerySection .carousel-item:first,#3DGallerySection .carousel-item:first').addClass('active');
  $("#heroBanner").carousel({
    interval: 4000
  });
  //Stop Auto play
  $('#3DGallerySection,#viewGallerySection').carousel({
    pause: true,
    interval: false
  });

  //Inquery Form Cancel
  $('#inquery-form').find('.btn-secondary').on('click', function () {
    $("#inquery-form").modal("hide");
  });
  //Hide Date RangePicker and remove Active Classes 
  $('#blogCarousel').owlCarousel({
    center: true,
    loop: true,
    margin: 30,
    nav: true,
    slideTransition: 'linear',
    animateIn: true,
    animateOut: true

  });
  $('#offerCarousel').owlCarousel({
    loop: true,
    items: 1,
    dots: true,
    responsiveClass: true
  });

  //Zoom Gallery
  $('#overviewGallery').owlCarousel({
    loop: true,
    center: true,
    margin: 30,
    nav: true,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 3
      },
      1000: {
        items: 3,
        slideBy: 1
      }
    }
  });
  $('#socialFeed').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 4,
        slideBy: 4
      }
    }
  });

  //Captcha
  if ($(".form-item-your-email-address").hasClass("has-error")) {
    $(".sign-up-block .alert-dismissible").addClass('show');
    $(".sign-up-block .alert-dismissible").removeClass('hide');
  }
  else {
    $(".sign-up-block .alert-dismissible").addClass('hide');
    $(".sign-up-block .alert-dismissible").removeClass('show');
  }
  //Label Remove after confirmation
  if ($('.webform-confirmation').length != 0) {
    $('.webform-confirmation').parents('.input-group').parent().find('label').hide();
    $('.comments-section .webform-confirmation').parent().prev('h5').hide();
  }

  function validationChk(selector) {
    $(selector).find('.webform-submission-form').find('.webform-button--submit').click(function (e) {
      e.preventDefault();
      var email = $(this).parents('form').find('input[type="email"]'),
        pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

      if (email.val() === '' || email.val() == null) {
        email.addClass('error');
        $('.validation-msg').text('Please Enter your email address').show();
        return false;
      } else if (!pattern.test(email.val())) {
        $('.validation-msg').text('Email Id is not valid').show();
        return false;
      } else if (!$('input.form-checkbox').is(':checked')) {
        email.removeClass('error');
        $('.validation-msg').text('Please select the checkbox for Welk Exclusive Offers').show();
        return false;
      } else if (grecaptcha.getResponse() == '') {
        $('.validation-msg').text('reCAPTCHA is mandatory').show();
        return false;
      }
      $('.validation-msg').hide();
      $(this).parents('form').submit();
    });
  }
  if ($('body').hasClass('page-node-type-blog')) {
    validationChk('.sign-up-block.secondary');
  } else {
    validationChk('.sign-up-block');
  }

  $('.comments-section').find('form').on('submit', function () {
    if (grecaptcha.getResponse() == '') {
      $('.validation-msg').show();
      return false;
    }
    $('.validation-msg').hide();
  });
  //Max Length
  function maxlength(selector) {
    max_length = $(selector).attr("maxlength");
    $(selector).attr("onkeypress", "if(this.value.length >= max_length) return false;");
  }
  maxlength('.comments-section input[name="first_name"]');
  maxlength('.comments-section input[name="last_name"]');


  //Blog Filter for Mobile
  var baseUrlPath = window.location.origin + window.location.pathname;
  $('.categories-block.blogs .views-exposed-form .form-select').find('.form-group').each(function () {
    var listItemVal = $(this).find('a');
    //Dynamic option create
    $('<option>' + listItemVal.text() + '</option>').appendTo($('.categories-block.blogs .filter-block'));

    //URL Setting for Option
    var optionVal = $('.categories-block.blogs').find('.filter-block option');
    optionVal.filter(function () {
      if ($.trim($(this).text()) == $.trim(listItemVal.text())) {
        $(this).val(listItemVal.attr('href'));
      }
    });

    //URL open on change option
    $('.categories-block.blogs select').on('change', function () {
      var url = $(this).val(); // get selected value
      if (url) { // require a URL
        window.location = url; // redirect        
      }
      return false;
    });
    optionVal.filter(function () {
      if ($.trim($(this).val()) == baseUrlPath) {
        $(this).attr('selected', true);
      }
    });
  });
  //Disable main link if dropdown available
  $('.secondary-nav li').each(function () {
    if ($(this).find('ul').length == 1) {
      var $this = $(this);
      $(this).find('li').each(function () {
        if ($(this).find('a').text() == 'Weddings') {
          $this.find('ul').prev('a').addClass('no-link');
          $this.find('ul').prev('a').on('click', function () {
            return false;
          });
        }
      });
    }
  });
  //Offer Highlight;
  $(window).on("load", function () {
    var urlHash = window.location.href.split("#")[1];
    if ($('#offer' + urlHash).length) {
      $('html,body').animate({
        scrollTop: $('#offer' + urlHash).offset().top - 210
      }, 2000);
    }
    $('#offer' + urlHash).addClass('active');
  });

  // Footer Social Media New Tab
  $('.footer-wrapper .social-media').find('a').on('click', function (event) {
    event.preventDefault();
    var url = $(this).attr('href');
    window.open(url, '_blank');
  });

  $('.footer-wrapper li a').click(function () {
    if ($(this).text() == 'Owners') {
      var url = $(this).attr('href');
      window.open(url, '_blank');
    }
  });

  //View more blocks
  function viewMoreBlocks(selector, counter, nextItemsCount, eventHandle) {
    $(selector).hide();
    var list = $(selector).length,
      count = counter;
    $(selector + ':lt(' + count + ')').show();
    //More Blocks
    $(eventHandle).click(function (e) {
      e.preventDefault();
      var $this = $(this);
      count = (count + nextItemsCount <= list) ? count + nextItemsCount : list;
      $(selector + ':lt(' + count + ')').slideDown('slow');
      if (count == list) {
        $this.hide();
      }
    });
  }
  viewMoreBlocks('.path-blogs .posts-components .row >.col-lg-4', 6, 5, '.path-blogs .posts-components a.btn-primary');
  viewMoreBlocks('.page-node-type-blog .posts-components .row >.col-lg-4', 3, 3, '.page-node-type-blog .posts-components a.btn-primary');
  viewMoreBlocks('#weekday-listing .activities .activity-details', 6, 5, '.activities-block a.btn-primary');
  viewMoreBlocks('#everyday-listing .activities .activity-details', 6, 5, '.activities-block a.btn-primary');
  viewMoreBlocks('#all-bedroom-listing .view-rooms-listing-page .view-content > .row', 3, 3, '.rooms-available a.btn-primary');
  viewMoreBlocks('#one-bedroom-listing .view-rooms-listing-page .view-content > .row', 3, 3, '.rooms-available a.btn-primary');
  viewMoreBlocks('#two-bedroom-listing .view-rooms-listing-page .view-content > .row', 3, 3, '.rooms-available a.btn-primary');
  viewMoreBlocks('#three-bedroom-listing .view-rooms-listing-page .view-content > .row', 3, 3, '.rooms-available a.btn-primary');

  // Tooltip
  //$('[data-toggle="tooltip"]').tooltip();
  $('#bestRateGuaranted').hide();
  var bestRateText = $('#bestRateGuaranted').find('.block').find('.field--item p').text();
  $('.best-rates').attr('title', bestRateText).tooltip();

  //Hash Linking Margin
  window.addEventListener("hashchange", function () {
    window.scrollTo(window.scrollX, window.scrollY - 109);
  });
  $('.download-view').on('click', function () {
    var url = $(this).attr('name');
    window.open(url, '_blank');
  });

});
