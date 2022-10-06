<script>
    import Chart from 'chart.js/auto'
    import axios from "axios";
    
    const answersURL = "http://127.0.0.1:8000/api/doughnutChart/";
    let dataCount = [];
    let dataLabel = []
    // defineProps({
    //   id: {
    //     type: String,
    //     required: true,
    //   },
    // });
    export default {
      name: ' DoughnutChart',
      props: {
        id: {
          type: Number,
          required: true,
        },
      },
      data(){
            return{
                dataState:"", // state of data for display
                data : {
                  value :[],
                  count : []
                },
                canvaId:'myChartDougnut-'+this.id
            }
        },
      mounted(){
      // console.log(this.canvaId)

        this.getData(answersURL+this.id)
      },
      methods: {
        getData(url){
          axios.get(url) // get datas from db
            .then((response) => {
              this.data.value = response.data.value
              this.data.count = response.data.count
              this.pushIntoArray(this.data.value, dataLabel)
              this.pushIntoArray(this.data.count, dataCount)
              this.getChartDoughnut(dataCount,dataLabel)
    
                this.dataState = true; // if datas is return from db then it will be true
            })
            .catch((error) => { // catch error
               console.log(error)
                this.dataState = false; // if error is return from db then it will be false
            });
        },
    
        pushIntoArray(array, store ){
          array.forEach(element => {
            // console.log(element);
            store.push(element)
          });
        },
        getChartDoughnut(doughnutData, name){
          const ctx = document.getElementById(this.canvaId);
          const data = {
          labels: name,
          datasets: [{
            label: 'My First Dataset',
            data: doughnutData,
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)',
              'rgb(69, 255, 235)',
              'rgb(213, 12, 150)',
    
            ],
            hoverOffset: 4
          }]
        };
        const myChart = new Chart(ctx, {
          type: 'doughnut',
          data: data,
    });
        }
        
      }
    }
    </script>
    <template>
      <div>
        <canvas :id=this.canvaId></canvas>
      </div>
      
      </template>