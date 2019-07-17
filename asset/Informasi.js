
function grafik(Pria, Wanita, id){
	var ctx = document.getElementById(id);
			  var mybarChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels: ["<= 25", "25 - 30", "31 - 35", "36 - 40", "41 - 45", "46 - 50", "51 - 55", ">= 55"],
				  datasets: [{
					label: 'Pria',
					backgroundColor: "#26B99A",
					data: Pria/*[51, 30, 40, 28, 92, 50, 45]*/
				  }, {
					label: 'Wanita',
					backgroundColor: "#03586A",
					data: Wanita/*[41, 56, 25, 48, 72, 34, 12]*/
				  }]
				},

				options: {
				  scales: {
					yAxes: [{
					  ticks: {
						beginAtZero: true
					  },
					  label: {
                  		text: 'Indeks SPM'
               		}
					}]
				  },
				  xAxes: [{
					  ticks: {
						beginAtZero: true
					  },
					  label: {
                  		text: 'Indeks SPM'
               		}
					}]
				}
			  });
}


function golongan(Pria, Wanita, id){
	var ctx = document.getElementById(id);
			  var mybarChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels: ["I", "II", "III", "IV"],
				  datasets: [{
					label: 'Pria',
					backgroundColor: "#26B99A",
					data: Pria/*[51, 30, 40, 28, 92, 50, 45]*/
				  }, {
					label: 'Wanita',
					backgroundColor: "#03586A",
					data: Wanita/*[41, 56, 25, 48, 72, 34, 12]*/
				  }]
				},

				options: {
				  scales: {
					yAxes: [{
					  ticks: {
						beginAtZero: true
					  }
					}]
				  }
				}
			  });
}


function pendidikan(Pria, Wanita, id){
	var ctx = document.getElementById(id);
			  var mybarChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels: ["SLTA", "D1", "D2", "D3", "D4", "Sarjana", "Magister", "Doktor"],
				  datasets: [{
					label: 'Pria',
					backgroundColor: "#26B99A",
					data: Pria/*[51, 30, 40, 28, 92, 50, 45]*/
				  }, {
					label: 'Wanita',
					backgroundColor: "#03586A",
					data: Wanita/*[41, 56, 25, 48, 72, 34, 12]*/
				  }]
				},

				options: {
				  scales: {
					yAxes: [{
					  ticks: {
						beginAtZero: true
					  }
					}]
				  }
				}
			  });
}


function kah(Pria, id){
	var	ctx = document.getElementById(id);
		var	   mybarChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels: ["Yogyakarta", "Sleman", "Bantul", "Kulonprogo", "Gunungkidul"],
				  datasets: [{
					label: 'Indeks KAH',
					backgroundColor: "#26B99A",
					data: Pria/*[51, 30, 40, 28, 92, 50, 45]*/
				  }]
				},

				options: {
				  scales: {
					yAxes: [{
					  ticks: {
						beginAtZero: true
					  }
					}]
				  }
				}
			  });
}