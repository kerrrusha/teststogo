<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-3 px-3 rounded">
        <a href="../index.php" class="text-center">
        	<img src="../images/logo.png" class="img" id='logo' style="max-width: 350px; min-width: 100px; width:100%;">
        </a>

        <button class="navbar-toggler" id="toggle_button" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../index.php#tab-1">ГОЛОВНА СТОРІНКА</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php#tab-2">СТАТИСТИКА</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php#tab-2">МІЙ АККАУНТ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php#tab-2">ІНФОРМАЦІЯ</a>
            </li>
            <!-- <li class="nav-item dropdown">
	            <a class="nav-link dropdown-toggle" href="" id="dropdown04" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
	            <div class="dropdown-menu" aria-labelledby="dropdown04">
	              <a class="dropdown-item" href="#">Action</a>
	              <a class="dropdown-item" href="#">Another action</a>
	              <a class="dropdown-item" href="#">Something else here</a>
	            </div>
	        </li> -->
          </ul>
          <form class="form-inline">
            <input class="form-control" type="text" placeholder="Пошук . . ." aria-label="Search">
          </form>
        </div>
</nav>

<!-- немного логики отображения -->
<script type="text/javascript">
	//согласование размеров логотипа с текущей шириной экрана
	var scale = function() {
	  	var logo = document.getElementById('logo');
	  	var toggle_button = document.getElementById('toggle_button');
		var window_width = document.documentElement.clientWidth;

		//отступы в пикселях
		var margins = 100;
		logo.style.width = (window_width - margins - toggle_button.offsetWidth).toString() + 'px';
	}
	window.addEventListener('resize', scale);
	document.addEventListener('DOMContentLoaded', scale);
</script>