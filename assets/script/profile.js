window.onload = function() {
    checkOnlineStatus();
};

function checkOnlineStatus() {//UserStatus[Online|Offline]
    let indicator = document.getElementById('Ind-Line');
    let online = navigator.onLine;

    if (indicator) {
        if (online) {
            indicator.style.borderBottom = '8px solid green';
        } else {
            indicator.style.borderBottom = '8px solid var(--sidebar-color)';
        }
    } else {
        console.error("Элемент с идентификатором 'Ind-Line' не найден")
    }
}

window.addEventListener('online', checkOnlineStatus);
window.addEventListener('offline', checkOnlineStatus);



document.addEventListener('DOMContentLoaded', (event) => {
    const body = document.querySelector("body"),
          Pil = body.querySelector(".Profile-info-left"),
          ProfileLeftButton = body.querySelector(".PLB"),
          Pir = body.querySelector(".Profile-info-right"),
          ProfileRightButton = body.querySelector(".PRB");

    ProfileLeftButton.addEventListener("click", () => {
      Pil.classList.toggle("close");
    });

    ProfileRightButton.addEventListener("click", () => {
      Pir.classList.toggle("close");
    });
  });



  // const scrollIndicator = document.querySelector('.scroll-indicator');
  // const containers = document.querySelectorAll('.container');

  // function updateScrollIndicator() {
  //   const scrollTop = window.pageYOffset;
  //   const windowHeight = window.innerHeight;
  //   const documentHeight = document.body.scrollHeight;

  //   const scrollPercentage = (scrollTop / (documentHeight - windowHeight)) * 100;

  //   containers.forEach((container, index) => {
  //     const segment = scrollIndicator.children[index];
  //     const containerTop = container.offsetTop - 2;
  //     const containerBottom = containerTop + container.offsetHeight;

  //     if (scrollTop >= containerTop && scrollTop <= containerBottom) {
  //       segment.classList.add('active');
  //     } else {
  //       segment.classList.remove('active');
  //     }

  //     segment.style.height = `${scrollPercentage}%`;
  //   });
  // }

  // containers.forEach(() => {
  //   const segment = document.createElement('div');
  //   segment.classList.add('scroll-segment');
  //   scrollIndicator.appendChild(segment);
  // });

  // window.addEventListener('scroll', updateScrollIndicator);

  // updateScrollIndicator();



  
  document.addEventListener('DOMContentLoaded', function() {  // Pulsate[On|Off]
    const pulsateToggle = document.getElementById('no-pulsate-switch');
    
    if (pulsateToggle) {
        pulsateToggle.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('no-pulsate');
                resetPulsatingElements(); // Убедитесь, что функция уже определена к этому моменту
            } else {
                document.body.classList.remove('no-pulsate');
            }
        });
    }
});






