<template>
  <div>
    <p>Title: {{ creative.title }}</p>
    <p class="small">Status: {{ creative.status }}</p>
  </div>
</template>

<script>
export default {
  name: "Creative",
  props: {
    creative: Object,
  },
};
</script>

<style scoped>
.small {
  font-size: 14px;
}
</style>