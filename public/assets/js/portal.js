toggleSubMenu = function (id) {
    // #submenu
    const subMenu = document.getElementById(`submenu-${id}`);
    const getSubMenuDisplay = subMenu.style.getPropertyValue('display');
    // slide .popup-sub-menu animation
    // const popUpAnimation = document.querySelector('.popup-sub-menu');

    if(getSubMenuDisplay !== 'block'){
      subMenu.style.display = 'block';
      document.querySelector('.container').style.overflow = 'hidden'
      // popUpAnimation.style.animation = 'slideUp 0.5s ease-in-out'
    }
    else{
      subMenu.style.display = 'none';
      // popUpAnimation.style.animation = 'slideDown 0.5s ease-in-out'
      document.querySelector('.container').style.overflow = 'auto'
    }
  }

