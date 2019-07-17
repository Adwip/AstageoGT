

function grafikKAH (id, nilai, tahun, tanggal){
            var chart = {
               type: 'column'
            };
            var title = {
               text: 'Informasi KAH tahun '+tahun   
            };
            var subtitle = {
               text: 'BMKG DIY Stasiun Geofisika <br> '+tanggal
            };
            var xAxis = {
               //categories: [1,2,3,4],
                  title: {
                     text:'Minggu'
                  },
               allowDecimals: false
            };
            var yAxis = {
               title: {
                  text: 'Indeks Ph KAH'
               },
               allowDecimals: true,
               plotLines: [{
                  value: 7,
                  width: 2,
                  color: 'red'
               }]
            };
            var plotOptions = {
               line: {
                  dataLabels: {
                     enabled: true
                  },   
                  enableMouseTracking: true
               },
               series: {
                  pointStart: 1
               }

            };   
            var tooltip = {
               /*valueSuffix: ' µgram/m3',
               height: 20,*/
               backgroundColor: '#FCFFC5',
               borderColor: 'black',
               borderRadius: 10,
               formatter: function() {
                  return 'Indeks Ph bulan <b>' + this.series.name + '</b> di minggu ke <b>' + this.x + '</b>, adalah <b>'+ this.y+' µgram/m3</b>';
               }
            }

            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
            var series =  nilai ;

            var navigation = {
                 buttonOptions: {
                     enabled: true
                 }
             };

             var exporting = {
               filename: 'Info-KAH-tahun-'+tahun
             }

            var json = {};
            //json.chart = chart;
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;
            json.plotOptions = plotOptions;
            json.navigation = navigation;
            json.exporting = exporting;
            
            $(id).highcharts(json);
}

function grafikSPM (id, nilai, tahun, tanggal){
   var title = {
               text: 'Informasi SPM tahun '+tahun   
            };
            var subtitle = {
               text: 'BMKG DIY Stasiun Geofisika <br> '+tanggal
            };
            var xAxis = {
               //categories: [1,2,3,4],
                  title: {
                     text:'Minggu'
                  },
               allowDecimals: false
            };
            var yAxis = {
               title: {
                  text: 'Indeks SPM'
               },
               allowDecimals: true,
               plotLines: [{
                  value: 7,
                  width: 5,
                  color: 'red'
               }]
            };
            var plotOptions = {
               line: {
                  dataLabels: {
                     enabled: true
                  },   
                  enableMouseTracking: true
               },
               series: {
                  pointStart: 1
               }

            };   
            var tooltip = {
               /*valueSuffix: ' µgram/m3',
               height: 20,*/
               backgroundColor: '#FCFFC5',
               borderColor: 'black',
               borderRadius: 10,
               formatter: function() {
                  return 'Indeks SPM bulan <b>' + this.series.name + '</b> di minggu ke <b>' + this.x + '</b>, adalah <b>'+ this.y+' µgram/m3</b>';
               }
            }

            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
            var series =  nilai;

            var navigation = {
                 buttonOptions: {
                     enabled: true
                 }
             };

             var exporting = {
               filename: 'Info-SPM-tahun-'+tahun
             }

            var json = {};
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;
            json.plotOptions = plotOptions;
            json.navigation = navigation;
            json.exporting = exporting;
            
            $(id).highcharts(json);
}

function partikulat25 (id, Yog, Sle, Ban, Kul, Gun){
   var title = {
               text: 'Informasi Konsentrasi Partikulat (PM2.5)'   
            };
            var subtitle = {
               text: 'Source: worldClimate.com'
            };
            var xAxis = {
               categories: ['0', '1', '2', '3', '4', '5',
                  '6', '7', '8', '9', '10', '11','12','13','14','15','16','17',
                  '18','19','20','21','22','23'],
                  title: {
                     text:'jam'
                  }
            };
            var yAxis = {
               title: {
                  text: 'Konsentrasi PM 2.5'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   
            var tooltip = {
               valueSuffix: ' µgram/m3'
            }
            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
            var series =  [{
                  name: 'Yogyakarta',
                  data: Yog
               }, 
               {
                  name: 'Sleman',
                  data: Sle
               }, 
               {
                  name: 'Bantul',
                  data: Ban
               },
               {
                  name: 'Kulonprogo',
                  data: Kul
               },
               {
                  name: 'Gunungkidul',
                  data: Gun
               }
            ];

            var json = {};
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;
            
            $(id).highcharts(json);
}

function distribusiUmur(pria, wanita){
   var chart = {
               type: 'column'
            };
            var title = {
               text: 'Distribusi umur BMKG DIY'   
            };
            var subtitle = {
               text: 'Source: WorldClimate.com'  
            };
            var xAxis = {
               categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul',
                  'Aug','Sep','Oct','Nov','Dec'],
               crosshair: true
            };
            var yAxis = {
               min: 0,
               title: {
                  text: 'Rainfall (mm)'         
               }      
            };
            var tooltip = {
               headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
               pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style = "padding:0"><b>{point.y:.1f} mm</b></td></tr>',
               footerFormat: '</table>',
               shared: true,
               useHTML: true
            };
            var plotOptions = {
               column: {
                  pointPadding: 0.2,
                  borderWidth: 0
               }
            };  
            var credits = {
               enabled: false
            };
            var series= [
               {
                  name: 'Tokyo',
                  data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6,
                     148.5, 216.4, 194.1, 95.6, 54.4]
               }, 
               {
                  name: 'New York',
                  data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3,
                     91.2, 83.5, 106.6, 92.3]
               }
            ];     
         
            var json = {};   
            json.chart = chart; 
            json.title = title;   
            json.subtitle = subtitle; 
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;  
            json.series = series;
            json.plotOptions = plotOptions;  
            json.credits = credits;
            $('#container').highcharts(json);
}