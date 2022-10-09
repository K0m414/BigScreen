<script>
    import DoughnutChart from "@/components/admin/DoughnutChart.vue";
    import RadarChart from "@/components/admin/RadarChart.vue";

export default {
  name: 'AllCharts',
  components: {
    DoughnutChart,
    RadarChart
  }
}
</script>
<template>
    <main>
      <DoughnutChart :id="6" />
      <DoughnutChart :id="7" />
      <DoughnutChart :id="10" />
      <RadarChart />
    </main>
</template>
