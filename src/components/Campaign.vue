<template>
  <div>
    <h3>Title: {{ campaign.title }}</h3>
    <h4>Date: {{ campaign.start_date }}</h4>
    <h5>Status: {{ campaign.status }}</h5>
    <div
      v-for="singleCreative in campaign.creatives"
      :key="singleCreative.title"
    >
      <Creative :creative="singleCreative" />
    </div>
  </div>
</template>

<script>
import Creative from "./Creative";

export default {
  name: "Campaign",
  props: {
    campaign: Object,
  },
  components: {
    Creative,
  },
};
</script>

<style>
</style>