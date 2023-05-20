window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    var serviceSection = document.getElementById('service');
    var navbarHeight = navbar.offsetHeight;
    var serviceSectionOffset = serviceSection.offsetTop;
    var windowHeight = window.innerHeight;

    console.log(navbarHeight);
    console.log(serviceSectionOffset);
    console.log(windowHeight);
  
    if (window.pageYOffset >= serviceSectionOffset - windowHeight + navbarHeight + 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
  