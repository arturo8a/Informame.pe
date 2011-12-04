			<?php
mysql_connect("localhost","root","");
mysql_select_db("pruebas");
?>

<html>

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<title>jQuery UI Example Page</title>

		<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>

		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>

		<script type="text/javascript">

			$(function(){



				// Accordion

				$("#accordion").accordion({ header: "h3" });

	

				// Tabs

				$('#tabs').tabs();

	



				// Dialog			

				$('#dialog').dialog({

					autoOpen: false,

					width: 600,

					buttons: {

						"Ok": function() { 

							$(this).dialog("close"); 

						}, 

						"Cancel": function() { 

							$(this).dialog("close"); 

						} 

					}

				});

				

				// Dialog Link

				$('#dialog_link').click(function(){

					$('#dialog').dialog('open');

					return false;

				});



				// Datepicker

				$('#datepicker').datepicker({

					inline: true

				});

				

				// Slider

				$('#slider').slider({

					range: true,

					values: [17, 67]

				});

				

				// Progressbar

				$("#progressbar").progressbar({

					value: 20 

				});

				

				//hover states on the static widgets

				$('#dialog_link, ul#icons li').hover(

					function() { $(this).addClass('ui-state-hover'); }, 

					function() { $(this).removeClass('ui-state-hover'); }

				);

				

			});

		</script>

		<style type="text/css">

			/*demo page css*/

			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}

			.demoHeaders { margin-top: 2em; }

			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}

			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}

			ul#icons {margin: 0; padding: 0;}

			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}

			ul#icons span.ui-icon {float: left; margin: 0 4px;}

		</style>	

	</head>

	<body>

	
		<!-- Tabs -->

		<h2 class="demoHeaders">Presupuestos</h2>

		<div id="tabs">

			<ul>

				<li><a href="#tabs-1">Bienes y Servicios</a></li>

				<li><a href="#tabs-2">Gastos</a></li>

				<li><a href="#tabs-3">Ingresos</a></li>

			</ul>

			
			
<?php
$query = mysql_query("SELECT p.proveedor,sum(a.total) as total FROM adquisiciones a inner join proveedor p on p.id_proveedor=a.proveedor group by p.proveedor order by sum(a.total) desc limit 10");
?>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data1 = new google.visualization.DataTable();
	  
	  
      data1.addColumn('string', 'Proveedor');
      data1.addColumn('number', 'Total');
	  data1.addRows(
	    [
		<?php
		while($data = mysql_fetch_assoc($query))
		{
		echo "['".$data[proveedor]."	s./".$data[total]."',".$data[total]."],";
		}
		?>
       ]
	  );

      // Set chart options
      var options1 = {'title':'Informacion de Adquisiciones de Bienes y Servicios realizadas por la Municipalidad Metropolitana de Lima',
                     'width':1300,
                     'height':500};

      // Instantiate and draw our chart, passing in some options.
      var chart1 = new google.visualization.PieChart(document.getElementById('tabs-1'));
      chart1.draw(data1, options1);
    }
    </script>


			<div id="tabs-1"></div>

			
			
			<?php
$query = mysql_query("SELECT det_especifica as especificacion,sum(monto) as total FROM `pgastos` group by `det_especifica` order by sum(monto) desc limit 10");
?>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data2 = new google.visualization.DataTable();
	  
	  
      data2.addColumn('string', 'Especificacion');
      data2.addColumn('number', 'Total');
	  data2.addRows(
	    [
		<?php
		while($data = mysql_fetch_assoc($query))
		{
		echo "['".$data[especificacion]."	s./".$data[total]."',".$data[total]."],";
		}
		?>
       ]
	  );

      // Set chart options
      var options2 = {'title':'Informacion de la ejecucion Presupuestal de gastos de la Municipalidad Metropolitana de Lima',
                     'width':1300,
                     'height':500};

      // Instantiate and draw our chart, passing in some options.
      var chart2 = new google.visualization.PieChart(document.getElementById('tabs-2'));
      chart2.draw(data2, options2);
    }
    </script>

			
			<div id="tabs-2"></div>

			
			
			<?php
$query = mysql_query("SELECT descripcion,sum(monto) as total FROM ingresos group by descripcion order by sum(monto) desc limit 10");
?>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data3 = new google.visualization.DataTable();
	  
	  
      data3.addColumn('string', 'Descripcion');
      data3.addColumn('number', 'Total');
	  data3.addRows(
	    [
		<?php
		while($data = mysql_fetch_assoc($query))
		{
		echo "['".$data[descripcion]."	s./".$data[total]."',".$data[total]."],";
		}
		?>
       ]
	  );

      // Set chart options
      var options3 = {'title':'Informacion Presupuestal de Ingresos de la Municipalidad Metropolitana de Lima',
                     'width':1300,
                     'height':500};

      // Instantiate and draw our chart, passing in some options.
      var chart3 = new google.visualization.PieChart(document.getElementById('tabs-3'));
      chart3.draw(data3, options3);
    }
    </script>

			<div id="tabs-3"></div>

		</div>


	</body>

</html>





