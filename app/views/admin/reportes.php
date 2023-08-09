<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- Columna derecha -->
		<div class="flex flex-col w-full space-y-8 md:w-3/4 bg-neutral  font-dmsans">

				<?php if(isset($data['usuarios'])) : ?>
					<div class="flex items-center bg-white rounded-xl p-4 w-full ">

						<div id="chart1" class="w-full h-max py-10"></div>


					</div>

					<div class="flex items-center bg-white rounded-xl p-4 w-full  ">


						<div id="chart" class="w-full h-max py-10"></div>

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

$usu = [];
$pro = [];
foreach($data['usuarios'] as $row) {
		array_push($usu, $row->total);
		array_push($pro, $row->rol);
}

?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>


<script>
let usuarios = JSON.parse('<?php echo json_encode($usu) ?>')
console.log(usuarios)
let prof = JSON.parse('<?php echo json_encode($pro) ?>')
console.log(prof)

        var options = {
          series: [{
          data: [12, 3, 22, 6]
        }],
          chart: {
          type: 'bar',
          height: 550
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Alisado con formol', 'Corte de Cabello', 'Spa de manos', 'Belleza de pies' ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


	        var options1 = {
          series: usuarios,
          chart: {
          width: 550,
          type: 'pie',
        },

        colors: ['#2E93fA', '#FF9800', '#263238'],
        labels: prof,
        title: {
          text: 'Product Trends by Month',
          align: 'center',
          margin: 10,
          offsetX: 0,
          offsetY: 0,
          floating: false,
          style: {
            fontSize:  '2rem',
            fontWeight:  'bold',
            fontFamily:  undefined,
            color:  '#263238'
          },
        },
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

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();
      


</script>
<?php require APPROOT . '/views/' . $data['controller'] . '/partials/footer.php'; ?>