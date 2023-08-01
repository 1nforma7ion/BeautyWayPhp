<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full md:h-screen flex flex-col md:flex-row md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="w-full md:w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- columna derecha -->
		<div class="flex w-full md:w-3/4 overflow-hidden font-dmsans">
			<div class="flex flex-col w-full p-4 h-screen  py-4 md:p-4  space-y-4  overflow-y-scroll no-scrollbar">

				<!-- publicaciones -->
				<?php foreach($data['publicaciones'] as $row) : ?>
					<div class=" flex flex-col-reverse md:flex-row bg-white text-dark drop-shadow-lg hover:drop-shadow-card rounded-lg">

					<div class="img_post relative flex w-full md:w-2/3 items-center">
						<img src="<?php echo URLROOT . $row->imagen ?>" alt="imagen logo" class="w-full h-72 md:h-96 object-cover rounded-b-lg md:rounded-br-none md:rounded-l-lg">
						<span class="date_post absolute w-max h-max top-4 left-0 rounded-r-lg text-sm text-dark p-2 bg-ctaDark md:text-xl font-bold"> 
						<?php echo $row->servicio ?>  </span>

						<div class="date_post absolute w-full flex justify-around h-max bottom-4 right-0 md:bottom-4  md:text-2xl font-bold">
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-heart "></i> Me gusta  </button>
							<button class="w-44 rounded-full text-sm text-dark p-2 bg-ctaDark "> <i class="fas fa-comment "></i> Comentarios  </button>

						</div>
					</div>
										
					<div class="relative md:h-96 w-full flex flex-col items-center p-4 md:w-1/3 space-y-4 ">
						<div class="flex space-x-4">

							<div class="flex flex-col justify-center items-center space-y-4">
								<div class="w-full flex items-center space-x-4">
									<?php if (!empty($data['imagenes_perfil'])) : ?>
										<img src="<?php echo URLROOT . $data['imagenes_perfil']->imagen_comercial ?>" class="h-16 w-16 rounded-full object-cover ">
									<?php else: ?>
										<img src="<?php echo URLROOT . '/img/user.png' ?>" alt="imagen usuario" class="h-16 w-16 rounded-full object-cover ">
									<?php endif; ?>

									<h1 ><a href="" class="text-dark hover:text-fbk text-xl  font-bold"> <?php echo $row->nombre_comercial ?></a></h1>
								</div>
								
								<div class="flex w-full justify-center items-center bg-primary rounded-xl p-1">
									<i class="fas fa-calendar-alt mr-2"></i>
									<span class="text-sm"> <?php echo fixedFecha($row->creado) ?> </span>	
								</div>
							</div>
						</div>
			      <span class=" text-sm"> <?php echo $row->descripcion ?>  </span>
	  				
	  				<div class="absolute hidden md:flex z-30 bottom-4 self-center text-sm text-fbk">
							<a href="<?php echo URLROOT . '/' . $data['controller'] . '/reservar' ?>" class=" rounded-full text-white text-xl px-4 py-2 md:w-max bg-neutralDark "> 
			      		Ver detalles<i class="fas fa-arrow-right ml-4 "></i>
			      	</a>
						</div>

					</div>

				</div>
				<?php endforeach; ?>

			</div>

		</div>

	</div>
</div>



	  <div class="col-xl-6 col-lg-6 mb-2">
	    <div class="card shadow">
	     	<div class="card-header text-center">
	        <h6 class="font-weight-bold">Cantidad de usuarios </h6>
	      </div>
	      
	    	<div class="card-body">
					<form action="estadistica.php" class="mb-4">
        		<div class="row g-1">
						  <div class="col">
						  	<div class="input-group">
								  <span class="input-group-text">Desde</span>
								  <input type="date" id="desde" name="desde" class="form-control" value="<?php echo $desde;?>">
								</div>
						  </div>
						  <div class="col">
						    <div class="input-group">
								  <span class="input-group-text">Hasta</span>
									<input type="date" id="hasta" name="hasta" class="form-control" value="<?php echo $hasta;?>">
								</div>
						  </div>
						  <div class="col-auto">
								<input type="submit" class="btn btn-success">
								<!-- <a href="estadistica.php" class="btn btn-danger"> Reset </a> -->
							</div>
						</div>
					</form>
	        <canvas id="canva3"></canvas>              
	      </div>
	    </div>
	  </div>


<div>
  <canvas id="myChart"></canvas>
</div>



	      
	    	<div class="card-body">
	        <canvas id="canva5"></canvas>               
	      </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php 

$usu = [];
$pro = [];
foreach($data['usuarios'] as $row) {
	if($row->rol_id ==2 ) {
		array_push($usu, $row);
	} else if ($row->rol_id == 3) {
		array_push($pro, $row);
	}
}

 ?>
<script>
	
let totalUsuarios = JSON.parse('<?php echo json_encode($data['usuarios']) ?>')
console.log(totalUsuarios)
let reservas = JSON.parse('<?php echo json_encode($usu) ?>')
let cupos = JSON.parse('<?php echo json_encode($pro) ?>')

reservas = reservas.length
cupos = cupos.length
console.log(cupos)

// Chart.defaults.global.defaultFontFamily = 'Nunito', 'Arial,sans-serif';
// Chart.defaults.global.defaultFontColor = '#333';

  let months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Setiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ];


new Chart(document.getElementById("canva5"), {
  type: 'bar',
  data: {
    labels: [0,1,2],

    datasets: [
      {
        label: "Reservas",
        backgroundColor: "#3e95cd",
        data: reservas
      }, 
      {
        label: "Cupos",
        backgroundColor: "#8e5ea2",
        data: cupos
      }
    ]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "N° de cupos Conferencias 2022"
    },
    responsive: true,
    // scales: {
    //   yAxes: [{ticks: {
    //     beginAtZero:true,
    //     min: 0,
    //     max: 22,
    //     stepSize: 1
    //   }}]
    // }
  }
});
</script>



<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      labels: months,
      datasets: [{
        label: '# of Votes',
        data: [reservas, cupos],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>