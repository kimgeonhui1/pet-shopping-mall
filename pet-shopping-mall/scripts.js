let currentSlide = 0;
let slideTimeout;

function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-image');
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }
    const offset = -currentSlide * 100;
    document.querySelector('.carousel-images').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    showSlide(currentSlide + 1);
    startSlideShow();
}

function prevSlide() {
    showSlide(currentSlide - 1);
    startSlideShow();
}

function startSlideShow() {
    stopSlideShow(); 
    slideTimeout = setTimeout(nextSlide, 5000);
}

function stopSlideShow() {
    clearTimeout(slideTimeout);
}

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);
    startSlideShow();
    
    const buttons = document.querySelectorAll('.category-btn');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const type = button.getAttribute('data-type');
            filterProducts(type);
        });
    });
});

function filterProducts(type) {
    const section = document.getElementById(type + '-products');
    section.scrollIntoView({ behavior: 'smooth' });
}

function checkEmail() {
  var email = document.getElementById('email').value;


  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState == XMLHttpRequest.DONE) {
          if (xhr.status == 200) {
              var response = xhr.responseText;
              if (response == 'exists') {
                  alert('이미 사용 중인 이메일입니다. 다른 이메일을 입력해 주세요.');
              } else {
                  alert('사용 가능한 이메일입니다.');
              }
          } else {
              alert('오류가 발생했습니다. 다시 시도해 주세요.');
          }
      }
  };

  xhr.open('POST', 'check_email.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('email=' + email);
}

function checkName() {
  var name = document.getElementById('uname').value;


  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState == XMLHttpRequest.DONE) {
          if (xhr.status == 200) {
              var response = xhr.responseText;
              if (response == 'exists') {
                  alert('이미 사용 중인 이름입니다. 다른 이름을 입력해 주세요.');
              } else {
                  alert('사용 가능한 이름입니다.');
              }
          } else {
              alert('오류가 발생했습니다. 다시 시도해 주세요.');
          }
      }
  };

  xhr.open('POST', 'check_name.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('name=' + name);
}