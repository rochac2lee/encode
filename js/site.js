window.onscroll = function() {scrollFunction()};
let android = 0
let website = 0
let gestao = 0
let sistemaDelivery = 0

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("main-navbar").style.top = "0";
  } else {
    document.getElementById("main-navbar").style.top = "-200px";
  }

  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    if (android == 0) {
      document.getElementById("android").innerHTML = '<div class="android-image04"><div class="android-image03"><div class="android-image02"><div class="android-image01">'
      android = 1;
    }
  }

  if (document.body.scrollTop > 650 || document.documentElement.scrollTop > 650) {
    if (gestao == 0) {
      document.getElementById("gestao").innerHTML = '<div class="gestao-image04"><div class="gestao-image03"><div class="gestao-image02"><div class="gestao-image01">'
      gestao = 1;
    }
  }

  if (document.body.scrollTop > 1200 || document.documentElement.scrollTop > 1200) {
    if (website == 0) {
      document.getElementById("website").innerHTML = '<div class="website-image03"><div class="website-image02"><div class="website-image01">'
      website = 1;
    }
  }

  if (document.body.scrollTop > 1800 || document.documentElement.scrollTop > 1800) {
    if (sistemaDelivery == 0) {
      document.getElementById("sistemaDelivery").innerHTML = '<div class="sistemaDelivery-image04"><div class="sistemaDelivery-image03"><div class="sistemaDelivery-image02"><div class="sistemaDelivery-image01">'
      sistemaDelivery = 1;
    }
  }
}

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
