<script>
  import Chart from 'chart.js/auto'
  import axios from "axios";
  
  const answersURL = "http://127.0.0.1:8000/api/radarChart";
  let dataCount = [];
  let dataLabel = []
  export default {
    name: ' Radar',
    data(){
      return{
          dataState:"", // state of data for display
          data : {
            value :[],
            count : []
          }
      }
    },
    mounted(){
      this.getData(answersURL)
    },
    methods: {
      getData(url){
        axios.get(url) // get datas from db
          .then((response) => {
            console.log(response);
            this.getChartRadar(response.data.count,response.data.value, 'sondage de qualité')
            this.dataState = true; // if datas is return from db then it will be true
          })
          .catch((error) => { // catch error
             console.log(error)
            this.dataState = false; // if error is return from db then it will be false
          });
      },
  
      // pushIntoArray(array, store ){
      //   array.forEach(element => {
      //     // console.log(element);
      //     store.push(element)
      //   });
      // },
      getChartRadar( array, label, title){
        const ctx = document.getElementById('myChartRadar');
        const data = {
        labels:label,
        datasets: [{
          label: title,
          data: array,
          fill: true,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgb(255, 99, 132)',
          pointBackgroundColor: 'rgb(255, 99, 132)',
          pointBorderColor: '#fff',
          pointHoverBackgroundColor: '#fff',
          pointHoverBorderColor: 'rgb(255, 99, 132)'
        }]
      };
        console.log(array)
        const myChartRadar = new Chart(ctx, {
          type: 'radar',
          data: data,
          options: {
            elements: {
              line: {
                borderWidth: 3
              }
            }
          },
        });
          
        // myChartRadar.destroy();
      }
      
    }
  }
  </script>
  <template>
    <div>
      <canvas id="myChartRadar" style="display: block; box-sizing: border-box; height: 800px; width: 800px;"></canvas>
    </div>
    
    </template>