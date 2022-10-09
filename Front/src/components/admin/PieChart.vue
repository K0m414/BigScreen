<script>
    import Chart from 'chart.js/auto'
    import axios from "axios";
    
    const answersURL = "http://127.0.0.1:8000/api/pieChart/";

    export default {
      name: ' pieChart',
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
                  question : "",
                },
                canvaId:'myChartPie-'+this.id
            }
        },
      mounted(){
        this.getData(answersURL+this.id)
      },
      methods: {
        getData(url){
          axios.get(url) // get datas from db
            .then((response) => {
              this.getChartPie(response.data.count,response.data.value, response.data.question)
              this.data.question =response.data.question,
              this.dataState = true; // if datas is return from db then it will be true
            })
            .catch((error) => { // catch error
               console.log(error)
                this.dataState = false; // if error is return from db then it will be false
            });
        },
        getChartPie(pieData, label,title ){
          console.log(title)
          const ctx = document.getElementById(this.canvaId);
          const data = {
          labels: label,
          datasets: [{
            label: title,
            data: pieData,
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
          type: 'pie',
          data: data,
    });
        }
        
      }
    }
    </script>
    <template>
    <article>
      <h3>{{this.data.question}}</h3>
      <div style="margin: auto 20%;">
        <canvas :id=this.canvaId></canvas>
      </div>
    </article>
        
      
      </template>