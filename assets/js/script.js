function myFunction() {
 var element = document.getElementById("konten");
 var element2 = document.getElementById("header");
 var element3 = document.getElementById("sidebar");

 element.classList.toggle("toggleNav");
 element2.classList.toggle("toggleNav");
 element3.classList.toggle("toggleNav2");
}

// sidebar menu collapse
// document.addEventListener("DOMContentLoaded", function(){

//   document.querySelectorAll('.menu-sidebar .nav-link').forEach(function(element){

//     element.addEventListener('click', function (e) {

//       let nextEl = element.nextElementSibling;
//       let parentEl  = element.parentElement;  

//       if(nextEl) {
//         e.preventDefault(); 
//         let mycollapse = new bootstrap.Collapse(nextEl);

//         if(nextEl.classList.contains('show')){
//           mycollapse.hide();
//         } else {
//           mycollapse.show();
//               // find other submenus with class=show
//               var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
//               // if it exists, then close all of them
//               if(opened_submenu){
//                 new bootstrap.Collapse(opened_submenu);
//               }

//             }
//           }

//         });
//   })

// }); 
// DOMContentLoaded  end

// jam
window.setTimeout("waktu()", 1000);

function waktu() {
  var waktu = new Date();
  setTimeout("waktu()", 1000);
  document.getElementById("jam").innerHTML = waktu.getHours();
  document.getElementById("menit").innerHTML = waktu.getMinutes();
  document.getElementById("detik").innerHTML = waktu.getSeconds();
}

// ASCII jadi patokan char
// filter angka dalam field (harus disempurnakan)
function hanyaHuruf(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if ((charCode < 65) || (charCode == 32))
  return false;
  return true;
}
// ASCII jadi patokan char
// filter huruf dalam field
function hanyaAngka(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 // pengecekan jika yang di input adalah angka, maka akan mengembalikan nilai true pada form
 if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;
}