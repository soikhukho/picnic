
//label - value
function push_chart_revenue_status(type,month,id_result){
    
    $.post('php_form_admin/ajax_chart_revenue_month.php',{month:month},function (data) {
        data=JSON.parse(data);

        var labels = [];
        var values = [];
        for (var i in data) {
            // labels.push('0')
            labels.push(data[i].label);

            // result.push('0')
            
            values.push(data[i].value); 
        }
        console.log(labels)

    let myChart = document.getElementById(id_result).getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    

    let massPopChart = new Chart(myChart, {
      type:type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:labels,
        datasets:[{
          label:'xx',
          data:values,
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
    })

}

function push_chart_revenue_received(type,result_id){
    
    $.post('php_form_admin/ajax_chart_revenue_all.php',function (data) {
        data=JSON.parse(data);

        var labels = [];
        var values = [];
        for (var i in data) {
            // labels.push('0')
            labels.push(data[i].label);

            // result.push('0')
            
            values.push(data[i].value); 
        }
        console.log(labels)

    let myChart = document.getElementById(result_id).getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    

    let massPopChart = new Chart(myChart, {
      type:type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:labels,
        datasets:[{
          label:'xx',
          data:values,
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });

    })

}

function push_chart_revenue_game(type,month_start, month_end , result_id){
  $.post('php_form_admin/ajax_chart_revenue_game.php',{month_start:month_start , month_end:month_end},
            function(data){
               data=JSON.parse(data);
               
                var labels = [];
                var values = [];
                for (var i in data) {
                    // labels.push('0')
                    labels.push(data[i].label);

                    // result.push('0')
                    
                    values.push(data[i].value); 
                }
                console.log(labels)

            let myChart = document.getElementById(result_id).getContext('2d');

            // Global Options
            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.defaultFontColor = '#777';

            

            let massPopChart = new Chart(myChart, {
              type:type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
              data:{
                labels:labels,
                datasets:[{
                  label:'xx',
                  data:values,
                  //backgroundColor:'green',
                  backgroundColor:[
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                  ],
                  borderWidth:1,
                  borderColor:'#777',
                  hoverBorderWidth:3,
                  hoverBorderColor:'#000'
                }]
              },
              options:{
                title:{
                  display:true,
                  text:'',
                  fontSize:25
                },
                legend:{
                  display:true,
                  position:'right',
                  labels:{
                    fontColor:'#000'
                  }
                },
                layout:{
                  padding:{
                    left:50,
                    right:0,
                    bottom:0,
                    top:0
                  }
                },
                tooltips:{
                  enabled:true
                }
              }
            });
            })
}
