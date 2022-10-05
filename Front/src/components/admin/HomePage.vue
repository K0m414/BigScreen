<script>
import Chart from 'chart.js/auto'
import axios from "axios";

const answersURL = "http://127.0.0.1:8000/api/doughnutChart/7";
let dataCount = [];
let dataLabel = []
export default {
  name: ' Doughnut',
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
      const ctx = document.getElementById('myChart');
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
    <canvas id="myChart"></canvas>
  </div>
  
  </template>