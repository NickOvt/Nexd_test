<template>
  <div class="col-sm-4 col-lg-2">
    <form @submit="onSubmit">
      <div class="form-group">
        <label for="title" class="form-label">Creative title</label>
        <input
          type="text"
          v-model="title"
          name="title"
          class="form-control"
          placeholder="Add new Creative"
        />
      </div>
      <div class="form-group">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" v-model="statusText" name="status">
          <option>Draft</option>
          <option>Live</option>
          <option>Finished</option>
        </select>
      </div>
      <button type="submit" class="btn btn-outline-primary">
        Add new creative
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: "CreateCampaign",
  data() {
    return {
      title: "",
      status: 0,
      statusText: "Draft",
    };
  },
  methods: {
    onSubmit(e) {
      e.preventDefault();

      // Simple validation
      if (!this.title) {
        alert("Please specify the title of the new Creative");
        return;
      }

      let currentStatus;
      if (this.statusText == "Draft") currentStatus = 0;
      else if (this.statusText == "Live") currentStatus = 1;
      else if (this.statusText == "Finished") currentStatus = 2;

      const newCreative = {
        title: this.title,
        status: currentStatus,
      };

      this.$emit("add-creative", newCreative);

      this.title = "";
      this.status = 0;
      this.statusText = "Draft";
    },
  },
};
</script>

<style>
</style>