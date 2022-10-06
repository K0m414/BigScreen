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
            this.data.value = response.data.value
            this.data.count = response.data.count
            this.pushIntoArray(this.data.value, dataLabel)
            this.pushIntoArray(this.data.count, dataCount)
            this.getChartRadar(dataCount,dataLabel)
  
              // this.dataState = true; // if datas is return from db then it will be true
          })
          .catch((error) => { // catch error
             console.log(error)
              // this.dataState = false; // if error is return from db then it will be false
          });
      },
  
      pushIntoArray(array, store ){
        array.forEach(element => {
          // console.log(element);
          store.push(element)
        });
      },
      getChartRadar( array, label){
        const ctx = document.getElementById('myChartRadar');
        const data = {
        labels: [
          "Combien donnez-vous de point pour la qualité de l’image sur Bigscreen ?", "Combien donnez-vous de point pour le confort d’utilisation de l’interface Bigscreen ?", "Combien donnez-vous de point pour la connexion réseau de Bigscreen ?", "Combien donnez-vous de point pour la qualité des graphismes 3D dans Bigscreen ?", "Combien donnez-vous de point pour la qualité audio dans Bigscreen ?"
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [ 2.36, 4.18, 3.56, 2.44, 2.78 ],
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