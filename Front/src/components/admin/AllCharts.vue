<script>
    import PieChart from "@/components/admin/PieChart.vue";
    import RadarChart from "@/components/admin/RadarChart.vue";

export default {
  name: 'AllCharts',
  components: {
    PieChart,
    RadarChart
  }
}
</script>
<template>
    <main>
      <PieChart :id="6" />
      <PieChart :id="7" />
      <PieChart :id="10" />
      <RadarChart />
    </main>
</template>
