<template>
  <div>
    <form class="form-group" @submit="onSubmit">
      <label for="status" class="form-label">Status</label>
      <select class="form-select" v-model="statusText" name="status">
        <option>Draft</option>
        <option>Live</option>
        <option>Finished</option>
      </select>
      <button type="submit" class="btn btn-primary">Change status</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "ChangeStatus",
  props: {
    currentStatus: Number,
  },
  data() {
    return {
      status: 0,
      statusText: "Draft",
    };
  },
  methods: {
    onSubmit(e) {
      e.preventDefault();

      if (this.statusText == "Draft") this.status = 0;
      else if (this.statusText == "Live") this.status = 1;
      else if (this.statusText == "Finished") this.status = 2;
      else {
        return;
      }

      this.$emit("change-status", this.status);

      this.statusText = "Draft";
    },
  },
  created() {
    if (this.currentStatus == 0) this.statusText = "Draft";
    else if (this.currentStatus == 1) this.statusText = "Live";
    else if (this.currentStatus == 2) this.statusText = "Finished";
  },
};
</script>

<style>
</style>