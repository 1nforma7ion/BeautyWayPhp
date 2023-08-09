<?php require APPROOT . '/views/' . $data['controller'] . '/partials/header.php'; ?>

<div class="flex flex-col w-full">
	<?php require APPROOT . '/views/' . $data['controller'] . '/partials/navbar.php'; ?>

	<div class="w-full h-screen flex md:space-x-4 pt-0 pb-4 px-4 md:px-6.5">

		<!-- columna izquierda -->	
		<div class="hidden md:block w-1/4  py-4 ">	
			<?php require APPROOT . '/views/' . $data['controller'] . '/partials/sidebar.php'; ?>
		</div>

		<!-- Columna derecha -->
		<div class="flex w-full md:w-3/4 bg-neutral  font-dmsans">

				<?php if(isset($data['usuarios'])) : ?>
					<div class="flex flex-col bg-white rounded-xl p-4 w-full space-y-4">

						<div id="chart1"></div>



					</div>
				<?php endif; ?>
			
		</div>


	</div>
</div>


<?php require APPROOT . '/views/' . $data['controller'] . '/partials/modal_add.php'; ?>

<?php 
echo "<pre>" ;
print_r($data);
// // print_r($data['profesiones']);
echo "</pre>";
?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>


<script>
	
	        var options1 = {
          series: [13, 7, 2],
          chart: {
          width: 480,
          type: 'pie',
        },

        colors: ['#2E93fA', '#FF9800', '#263238'],
        labels: ['Usuarios', 'Profesionales'],
        title: {
          text: 'Product Trends by Month',
          align: 'center',
          margin: 20,
          offsetX: 0,
          offsetY: 0,
          floating: false,
          style: {
            fontSize:  '1rem',
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