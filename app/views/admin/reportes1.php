<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full  flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- Columna derecha -->
		<div class="flex flex-col w-full space-y-8 md:w-3/4 py-4  font-dmsans">

				<?php if(isset($data['usuarios'])) : ?>
          <input type="hidden" id="url" data-root="<?php echo URLROOT ?>" data-controller="<?php echo $data['controller'] ?>">

          <!-- chart 1 -->
					<div class="flex flex-col items-center bg-white rounded-xl p-4 w-full ">

            <div class="w-full flex justify-between px-10 py-4 text-2xl text-neutral text-center">
              <h2 class="text-2xl md:text-4xl"> Reporte Usuarios </h2>
              <div class="w-1/3"> <?php showMsg(); ?>  </div>  
            </div>

            <div class="w-full md:w-3/4 flex flex-col md:flex-row items-center justify-between px-10 py-2 bg-primary rounded-xl ">

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Desde</span>
                  <input type="date" class="p-2 border-neutral " value="2023-08-02">
                </div>
              </div>

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Hasta</span>
                  <input type="date" class=" p-2 border-neutral " value="2023-08-05">
                </div>
              </div>

              <div class="md:w-max p-2">
                <button data-chart="chart1" class="btn_buscar w-1/2 md:w-32 w-max px-4 py-2 bg-neutral text-white">Buscar</button>
              </div>

            </div>

						<div id="chart1" class="w-full flex justify-center h-max px-4 py-10"></div>

					</div>

          <!-- chart 2 -->
          <div class="flex flex-col items-center bg-white rounded-xl p-4 w-full ">

            <div class="w-full flex justify-between px-10 py-4 text-2xl text-neutral text-center">
              <h2 class="text-2xl md:text-4xl"> Servicios Más Contratados </h2>
              <div class="w-1/3"> <?php showMsg(); ?>  </div>  
            </div>

            <div class="w-full md:w-3/4 flex flex-col md:flex-row items-center justify-between px-10 py-2 bg-primary rounded-xl ">

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Desde</span>
                  <input type="date" class="p-2 border-neutral " value="">
                </div>
              </div>

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Hasta</span>
                  <input type="date" class=" p-2 border-neutral " value="">
                </div>
              </div>

              <div class="md:w-max p-2">
                <button data-chart="chart2" class="btn_buscar w-1/2 md:w-32 w-max px-4 py-2 bg-neutral text-white">Buscar</button>
              </div>

            </div>

            <div id="chart2" class="w-full flex justify-center h-max p-4 md:p-10"></div>
            
          </div>

          <!-- chart 3 -->
          <div class="flex flex-col items-center bg-white rounded-xl p-4 w-full ">

            <div class="w-full flex justify-between px-10 py-4 text-2xl text-neutral text-center">
              <h2 class="text-2xl md:text-4xl"> Publicaciones Populares (Me gusta) </h2>
              <div class="w-1/3"> <?php showMsg(); ?>  </div>  
            </div>

            <div class="w-full md:w-3/4 flex flex-col md:flex-row items-center justify-between px-10 py-2 bg-primary rounded-xl ">

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Desde</span>
                  <input type="date" class="p-2 border-neutral " value="">
                </div>
              </div>

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Hasta</span>
                  <input type="date" class=" p-2 border-neutral " value="">
                </div>
              </div>

              <div class="md:w-max p-2">
                <button data-chart="chart3" class="btn_buscar w-1/2 md:w-32 w-max px-4 py-2 bg-neutral text-white">Buscar</button>
              </div>

            </div>

            <div id="chart3" class="w-full flex justify-center h-max p-4 md:p-10"></div>
            
          </div>

          <!-- chart 4 -->
          <div class="flex flex-col items-center bg-white rounded-xl p-4 w-full ">

            <div class="w-full flex justify-between px-10 py-4 text-2xl text-neutral text-center">
              <h2 class="text-2xl md:text-4xl"> Reservas por Zona </h2>
              <div class="w-1/3"> <?php showMsg(); ?>  </div>  
            </div>

            <div class="w-full md:w-3/4 flex flex-col md:flex-row items-center justify-between px-10 py-2 bg-primary rounded-xl ">

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Desde</span>
                  <input type="date" id="desde" class="p-2 border-neutral " value="">
                </div>
              </div>

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Hasta</span>
                  <input type="date" id="hasta" class=" p-2 border-neutral " value="">
                </div>
              </div>

              <div class="md:w-max p-2">
                <button id="buscar" class="w-1/2 md:w-32 w-max px-4 py-2 bg-neutral text-white">Buscar</button>
              </div>

            </div>

            <div id="chart4" class="w-full md:w-2/3 flex justify-center  py-10"></div>
            
          </div>

          <!-- chart 5 -->
          <div class="flex flex-col items-center bg-white rounded-xl p-4 w-full ">

            <div class="w-full flex justify-between px-10 py-4 text-2xl text-neutral text-center">
              <h2 class="text-2xl md:text-4xl"> Reservas Finalizadas por Modalidad </h2>
              <div class="w-1/3"> <?php showMsg(); ?>  </div>  
            </div>

            <div class="w-full md:w-3/4 flex flex-col md:flex-row items-center justify-between px-10 py-2 bg-primary rounded-xl ">

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Desde</span>
                  <input type="date" id="desde" class="p-2 border-neutral " value="2022-05-11">
                </div>
              </div>

              <div class="md:w-1/3 p-2">
                <div class="flex space-x-4 items-center">
                  <span class="text-xl">Hasta</span>
                  <input type="date" id="hasta" class=" p-2 border-neutral " value="2023-06-22">
                </div>
              </div>

              <div class="md:w-max p-2">
                <button id="buscar" class="w-1/2 md:w-32 w-max px-4 py-2 bg-neutral text-white">Buscar</button>
              </div>

            </div>

            <div id="chart5" class="w-full flex justify-center h-max px-4 py-10"></div>

          </div>

				<?php endif; ?>
		</div>


	</div>
</div>


<?php 
echo "<pre>" ;
print_r($data);
// // print_r($data['profesiones']);
echo "</pre>";

// chart 1
$usu = [];
$pro = [];
foreach($data['usuarios'] as $row) {
  if ( $row->rol != 'admin' ) {
    array_push($usu, intval($row->total));

    if ( $row->rol == 'usuariop') {
      array_push($pro, 'Profesional');
    } else {
      array_push($pro, ucwords($row->rol));
    }
  }
}

// chart 2
$c_serv = [];
$c_total = [];
foreach($data['contratados'] as $contratado_row) {
    array_push($c_total, intval($contratado_row->total));
    array_push($c_serv, mb_convert_encoding($contratado_row->servicio, 'UTF-8',  mb_list_encodings()));
}

// chart 3
$l_serv = [];
$l_total = [];
foreach($data['likes_serv'] as $like_row) {
    array_push($l_total, intval($like_row->me_gusta));
    array_push($l_serv, mb_convert_encoding($like_row->servicio, 'UTF-8',  mb_list_encodings()));
}

// chart 4
$zona = [];
$zona_total = [];
foreach($data['servicios_zona'] as $row_zona) {
    array_push($zona_total, intval($row_zona->total));
    array_push($zona, mb_convert_encoding($row_zona->zona_public, 'UTF-8',  mb_list_encodings()));
}

// chart 5
$modalidad = [];
$modalidad_total = [];
foreach($data['modalidades'] as $row_mod) {
    array_push($modalidad_total, intval($row_mod->total));
    array_push($modalidad, mb_convert_encoding($row_mod->modalidad, 'UTF-8',  mb_list_encodings()));
}

?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>


<script>
let chart_series_1 = JSON.parse('<?php echo json_encode($usu) ?>')
let chart_labels_1 = JSON.parse('<?php echo json_encode($pro) ?>')

let contratados_serv = JSON.parse('<?php echo json_encode($c_serv) ?>')
let contratados_total = JSON.parse('<?php echo json_encode($c_total) ?>')

let likes_serv = JSON.parse('<?php echo json_encode($l_serv) ?>')
let likes_total = JSON.parse('<?php echo json_encode($l_total) ?>')

let zonas = JSON.parse('<?php echo json_encode($zona) ?>')
let zonas_total = JSON.parse('<?php echo json_encode($zona_total) ?>')

let modalidad = JSON.parse('<?php echo json_encode($modalidad) ?>')
let modalidad_total = JSON.parse('<?php echo json_encode($modalidad_total) ?>')

console.log(chart_series_1)
console.log(chart_labels_1)

const options1 = {
  series: chart_series_1,
  chart: {
    width: 450,
    type: 'pie',
  },
  colors: ['#2CA02C','#FF7F0E'],
  labels: chart_labels_1,
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 400
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

let chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
chart1.render();


const options2 = {
  series: contratados_total,
    chart: {
    width: 550,
    type: 'pie',
  },
  colors: ['#2CA02C','#FF7F0E', '#D62728', '#1F77B4','#9467BD', '#8C564B', '#E377C2','#7F7F7F', '#BCBD22', '#02AAFE'],
  labels: contratados_serv,
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 400
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

//   series: [{
//     data: contratados_total
//   }],
//     chart: {
//     type: 'donut',
//     height: 350
//   },
//   plotOptions: {
//     bar: {
//       borderRadius: 4,
//       horizontal: true
//     }
//   },
//   colors: ['#2b908f', '#f9a3a4', '#90ee7e','#f48024', '#69d2e7'],
//   dataLabels: {
//     enabled: true,
//     textAnchor: 'start',
//     style: {
//       colors: ['#212121']
//     },
//     formatter: function (val, opt) {
//       return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
//     },
//     offsetX: 0,
//     dropShadow: {
//       enabled: false
//     }
//   },
//   xaxis: {
//     categories: contratados_serv,
//   }
// };

const chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
chart2.render();


const options3 = {
  series: likes_total,
    chart: {
    width: 550,
    type: 'donut',
  },
  colors: ['#2CA02C','#FF7F0E', '#D62728', '#1F77B4','#9467BD', '#8C564B', '#E377C2','#7F7F7F', '#BCBD22', '#02AAFE'],
  labels: likes_serv,
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 400
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};


//   series: [{
//     data: likes_total
//   }],
//     chart: {
//     type: 'bar',
//     height: 350
//   },
//   plotOptions: {
//     bar: {
//       borderRadius: 4,
//       horizontal: true
//     }
//   },
//   colors: ['#f48024', '#69d2e7'],
//   dataLabels: {
//     enabled: true,
//     textAnchor: 'start',
//     style: {
//       colors: ['#fff']
//     },
//     formatter: function (val, opt) {
//       return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
//     },
//     offsetX: 0,
//     dropShadow: {
//       enabled: false
//     }
//   },
//   xaxis: {
//     categories: likes_serv,
//   }
// };

const chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
chart3.render();


const options4 = {
  series: zonas_total,
    chart: {
    type: 'donut',
  },
  labels: zonas,
  responsive: [{
    breakpoint: 480,
    options: {
      plotOptions: {
        pie: {
          customScale: 0.6
        }
      },
      legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center', 
        floating: false,
        fontSize: '24px'
      }
    }
  }]
};

const chart4 = new ApexCharts(document.querySelector("#chart4"), options4);
chart4.render();
      
const options5 = {
  series: modalidad_total,
    chart: {
    width: 450,
    type: 'pie',
  },
  // colors: ['#2CA02C','#FF7F0E'],
  labels: modalidad,
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 400
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

const chart5 = new ApexCharts(document.querySelector("#chart5"), options5);
chart5.render();




  let url = document.querySelector('#url')
  let root = url.getAttribute('data-root')
  let controller = url.getAttribute('data-controller')
  let endpoint = `${root}/${controller}`
  // console.log(endpoint)

  const allBtnBuscar = document.querySelectorAll('.btn_buscar')
  allBtnBuscar.forEach(btn => {
    btn.addEventListener('click', e => {
      
      let desde_group = e.target.parentElement.previousElementSibling.previousElementSibling
      let desde_time = desde_group.querySelector('input').value

      let hasta_group = e.target.parentElement.previousElementSibling
      let hasta_time = hasta_group.querySelector('input').value

      let chart_num = e.target.getAttribute('data-chart')
      console.log(desde_time)
      console.log(hasta_time)

      if (chart_num == 'chart1') {

        let time_frame = JSON.stringify({ desde : desde_time, hasta : hasta_time, chart : chart_num })

        fetch(`${endpoint}/timeframe`, {
          method: 'post',
          body: time_frame,
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        })
        .then( res => res.json() )
        .then( data => {
          
          options1.series = data.chart_series
          // options1.labels = data.chart_labels
          chart1.destroy()

          let chart_search_1 = new ApexCharts(document.querySelector("#chart1"), options1);
          chart_search_1.render();

        })
        .catch(console.error)

      } else if (chart_num == 'chart2') {
        let time_frame = JSON.stringify({ desde : desde_time, hasta : hasta_time, chart : chart_num })

        fetch(`${endpoint}/timeframe`, {
          method: 'post',
          body: time_frame,
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        })
        .then( res => res.json() )
        .then( data => {
          
          options2.series = data.chart_series
          options2.labels = data.chart_labels
          chart2.destroy()

          let chart_search_2 = new ApexCharts(document.querySelector("#chart2"), options2);
          chart_search_2.render();

        })
        .catch(console.error)
      }

    })
  })



</script>
<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>