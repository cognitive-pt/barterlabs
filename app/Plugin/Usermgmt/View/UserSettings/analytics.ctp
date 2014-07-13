
<?php echo $this->Html->script('oocharts.js'); ?>  
<!-- Tracking Id: UA-51187144-1
	 Profile Id: 86337320
	 API Key: 7d3de1ebedaeb1f856ad29d499f5ec9f9f392d0a
-->

<div style="margin-left:100px;">
	<div>
		<h1>
		Data from last 24 hours
		</h1>
	</div>
	<div> 
	   New Visits : <span data-oochart='metric' 
	   					  data-oochart-metric='ga:newVisits' 
	   					  data-oochart-start-date='1d'
	   					  data-oochart-end-date
	   					  data-oochart-profile='86337320'></span>
	</div>

	<div>
	   Visits : <span data-oochart='metric' 
	   					  data-oochart-metric='ga:visits' 
	   					  data-oochart-start-date='1d' 
	   					  data-oochart-end-date
	   					  data-oochart-profile='86337320'></span>
	</div>
</div>

<div>
   				<div data-oochart='timeline' 
   					 data-oochart-start-date='1d' 
   					 data-oochart-metrics='ga:visits,Visits,ga:newVisits,New Visits' 
   				     data-oochart-profile='86337320'></div>
	
   				<div data-oochart='bar' 
   					 data-oochart-start-date='1d' 
   					 data-oochart-dimension='ga:continent' 
   					 data-oochart-metrics='ga:visits,Visits,ga:newVisits,New Visits' 
   					 data-oochart-profile='86337320'></div>

   				<div data-oochart='pie' 
   					 data-oochart-start-date='1d' 
   					 data-oochart-metric='ga:visits,Visits' 
   					 data-oochart-dimension='ga:browser' 
   					 data-oochart-profile='86337320'></div>
   					 
   				<div style="padding-left:250px; padding-right:250px;"
   					 data-oochart='table'
   					 data-oochart-start-date='1d' 
   					 data-oochart-metrics='ga:visits,Visits' 
   					 data-oochart-dimensions='ga:city,City' 
   					 data-oochart-profile='86337320'></div>
</div>	




<!-- seperator -->
<div style="margin-left:100px;">
	<div>
		<h1>
		Data from last 30 days
		</h1>
	</div>
	<div> 
	   New Visits : <span data-oochart='metric' 
	   					  data-oochart-metric='ga:newVisits' 
	   					  data-oochart-start-date='30d'
	   					  data-oochart-end-date
	   					  data-oochart-profile='86337320'></span>
	</div>

	<div>
	   Visits : <span data-oochart='metric' 
	   					  data-oochart-metric='ga:visits' 
	   					  data-oochart-start-date='30d' 
	   					  data-oochart-end-date
	   					  data-oochart-profile='86337320'></span>
	</div>
</div>

<div>
   				<div data-oochart='timeline' 
   					 data-oochart-start-date='30d' 
   					 data-oochart-metrics='ga:visits,Visits,ga:newVisits,New Visits' 
   				     data-oochart-profile='86337320'></div>
	
   				<div data-oochart='bar' 
   					 data-oochart-start-date='30d' 
   					 data-oochart-dimension='ga:continent' 
   					 data-oochart-metrics='ga:visits,Visits,ga:newVisits,New Visits' 
   					 data-oochart-profile='86337320'></div>

   				<div data-oochart='pie' 
   					 data-oochart-start-date='30d' 
   					 data-oochart-metric='ga:visits,Visits' 
   					 data-oochart-dimension='ga:browser' 
   					 data-oochart-profile='86337320'></div>
   					 
   				<div style="padding-left:250px; padding-right:250px;"
   					 data-oochart='table'
   					 data-oochart-start-date='30d' 
   					 data-oochart-metrics='ga:visits,Visits' 
   					 data-oochart-dimensions='ga:city,City' 
   					 data-oochart-profile='86337320'></div>
</div>	

        <script type="text/javascript">

            window.onload = function(){

                oo.setAPIKey("7d3de1ebedaeb1f856ad29d499f5ec9f9f392d0a");

                oo.load();
            };
        </script>