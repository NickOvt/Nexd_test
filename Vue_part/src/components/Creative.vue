<template>
  <div>
    <p>Title: {{ creative.title }}</p>
    <p class="small">Status: {{ creative.status }}</p>
    <ChangeStatus
      :currentStatus="creative.status"
      @change-status="changeStatus"
    />
  </div>
</template>

<script>
import ChangeStatus from "./ChangeStatus.vue";

export default {
  name: "Creative",
  components: {
    ChangeStatus,
  },
  props: {
    creative: Object,
  },
  methods: {
    changeStatus(updatedStatus) {
      const updatedCreative = { ...this.creative, status: updatedStatus };

      this.$emit("change-status", updatedCreative);
    },
  },
};
</script>

<style scoped>
.small {
  font-size: 14px;
}
</style>