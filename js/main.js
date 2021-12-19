'use strict'

$(window).scroll(function() {
    var scrollTop = $(this).scrollTop();
    var headerToDisplay = false;
    $('.header[data-visible-range]').each(function() {
        var range = $(this).data('visible-range').split('-');
        range[0] = range[0] ? parseInt(range[0], 10) : 0;
        range[1] = range[1] ? parseInt(range[1], 10) : $(document).height();
        if(scrollTop >= range[0] && scrollTop <= range[1]) {
            headerToDisplay = $(this);
            return false;
        }
    });
    if(headerToDisplay && !headerToDisplay.is(':visible')) {
        $('.header[data-visible-range]').hide();
        headerToDisplay.show();
    }
})

//установление ширины вкладок равномерной
    window.onload = function()
      {
        const tabsNames = document.querySelectorAll('.tabs-nav article');
        $('.tabs-nav article ').css('width', (100 / tabsNames.length).toString() + '%');  
      }
    
    //реализация функционирования динам. элемента jQuery - вкладок
    $(function()
    {
      var tab = $('#tabs .tabs-items > div'); 
      tab.hide().filter(':first').show(); 

      // Клики по вкладкам.
      $('#tabs .tabs-nav a').click
      (
      function()
      {
        tab.hide(); 
        tab.filter(this.hash).show(); 
        $('#tabs .tabs-nav a').removeClass('active');
        $(this).addClass('active');
        //console.log('Clicked!');
      }
      ).filter(':first').click();
      
      //обработка ссылки на определенную вкладку (#tab-1, #tab-2, #tab-3, #tab-4)
       var tabIndex = window.location.hash.replace('#tab-','') - 1;

       if (tabIndex != -1) 
        {
            $('#tabs .tabs-nav a').eq(tabIndex).click();
            console.log('Clicked url (from outer page) with index: ' + tabIndex.toString());
        }
        
      //скрыть якорь и удалить параметры из строки url (использовать только в самом конце страницы!!!)
      //history.pushState('', document.title, window.location.pathname + window.location.search);
    });