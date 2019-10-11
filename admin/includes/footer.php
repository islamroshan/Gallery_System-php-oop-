  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- WUSIWUG -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/script.js"></script>
    <!-- PIE CHART -->
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['User',      <?php echo $session->count; ?>],
          [' Comment',  <?php echo Comment::count_all(); ?> ],
          ['Users', <?php echo User::count_all(); ?> ],
          ['Photo', <?php echo Photo::count_all(); ?> ]

        ]);

        var options = {
        	legend: 'none',
        	pieSliceText : 'label',
          title: 'My Daily Activities',
          backgroundColor: 'transpa'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</body>

</html>
