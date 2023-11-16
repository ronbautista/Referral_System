$(document).ready(function () {
    $('#testBtn').click(function () {
        alert('Button clicked!');
    });
});

$(document).ready(function() {
    // JavaScript to toggle the sidebar
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleButton = document.getElementById('toggleButton');

    toggleButton.addEventListener('click', () => {
      sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0px';
      content.style.marginLeft = content.style.marginLeft === '0px' ? '250px' : '0px';
    });

    // Check the screen width and auto-collapse the sidebar
    function checkScreenWidth() {
      if (window.innerWidth <= 1400) {
        sidebar.style.left = '-250px';
        content.style.marginLeft = '0';
      } else {
        sidebar.style.left = '0px';
        content.style.marginLeft = '250px';
      }
    }

    // Call the function on page load and window resize
    window.addEventListener('load', checkScreenWidth);
    window.addEventListener('resize', checkScreenWidth);
});

$(document).ready(function () {
    $('.prenatal-datepicker').datepicker({
      format: 'mm/dd/yyyy',
      autoclose: true,
      todayHighlight: true
    });
  });