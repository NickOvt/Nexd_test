<template>
  <div class="mt-5">
    <ChangeStatus
      :currentStatus="campaign.status"
      @change-status="changeCampaignStatus"
    />
    <div>
      <h3>Title: {{ campaign.title }}</h3>
      <h4>Date: {{ campaign.start_date }}</h4>
      <h5>Status: {{ campaign.status }}</h5>
      <div
        v-for="singleCreative in campaign.creatives"
        :key="singleCreative.title"
      >
        <Creative
          :creative="singleCreative"
          @change-status="changeCreativeStatus"
        />
      </div>
    </div>
    <CreateCampaign @add-creative="addCreative" />
  </div>
</template>

<script>
import Creative from "./Creative";
import CreateCampaign from "./CreateCampaign";
import ChangeStatus from "./ChangeStatus";

export default {
  name: "Campaign",
  props: {
    campaign: Object,
  },
  components: {
    Creative,
    CreateCampaign,
    ChangeStatus,
  },
  methods: {
    addCreative(creative) {
      const updatedCampaign = {
        ...this.campaign,
        creatives: [...this.campaign.creatives, creative],
      };
      this.$emit("add-creative", updatedCampaign);
    },
    changeCampaignStatus(updatedStatus) {
      const updatedCampaign = { ...this.campaign, status: updatedStatus };

      this.$emit("change-status", updatedCampaign);
    },
    changeCreativeStatus(updatedStatusCreative) {
      const index = this.campaign.creatives.findIndex(
        (el) => el.title == updatedStatusCreative.title
      );

      let updatedCampaign = {
        ...this.campaign,
        creatives: [...this.campaign.creatives],
      };
      updatedCampaign.creatives[index] = updatedStatusCreative;

      this.$emit("change-creative-status", updatedCampaign);
    },
  },
};
</script>

<style>
</style>