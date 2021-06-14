<template>
  <div>
    <p>Title: {{ creative.title }}</p>
    <p class="small">Status: {{ getStatus }}</p>
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
  computed: {
    getStatus() {
      let currentStatus = this.creative.status;
      if (this.creative.status == 0) currentStatus = "Draft";
      else if (this.creative.status == 1) currentStatus = "Live";
      else if (this.creative.status == 2) currentStatus = "Finished";

      return currentStatus;
    },
  },
};
</script>

<style scoped>
.small {
  font-size: 14px;
}
</style>
