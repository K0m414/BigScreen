<script>
    import DoughnutChart from "@/components/admin/DoughnutChart.vue";

export default {
  name: 'AllCharts',
  components: {
    DoughnutChart
  }
}
</script>
<template>
    <main>
  
    <DoughnutChart :id="6" />
    <DoughnutChart :id="7" />
    <DoughnutChart :id="10" />


    </main>
</template>
