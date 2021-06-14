<template>
  <div class="container">
    <div class="form-group col-lg-3 my-4">
      <label for="dateSelect" class="form-label mt-4">Sort campaings</label>
      <select
        @change="sortCampaign(dateSortWay)"
        class="form-select"
        v-model="dateSortWay"
        name="dateSelect"
      >
        <option>Newest to oldest</option>
        <option>Oldest to newest</option>
      </select>
    </div>
    <div class="form-group col-lg-3 my-2">
      <label for="filterCampaigns" class="form-label mt-4"
        >Filter campaigns by status</label
      >
      <select
        @change="filterCampaign(currentStatusFilter)"
        name="filterCampaigns"
        v-model="currentStatusFilter"
        class="form-select"
      >
        <option>No filter</option>
        <option>Draft</option>
        <option>Live</option>
        <option>Finished</option>
      </select>
    </div>
    <div v-for="singleCampaign in filterCampaign" :key="singleCampaign.title">
      <Campaign
        :campaign="singleCampaign"
        @add-creative="addCreative"
        @change-status="changeCampaignStatus"
        @change-creative-status="changeCreativeStatus"
      />
    </div>
  </div>
</template>

<script>
import "bootswatch/dist/lux/bootstrap.min.css";
import Campaign from "./components/Campaign";

export default {
  name: "App",
  components: {
    Campaign,
  },
  methods: {
    sortCampaign(whichWay) {
      const newestToLatest = whichWay == "Newest to oldest" ? true : false;

      this.campaigns.sort((a, b) =>
        newestToLatest
          ? new Date(b.start_date) - new Date(a.start_date)
          : new Date(a.start_date) - new Date(b.start_date)
      );
    },
    addCreative(updatedCampaign) {
      const index = this.campaigns.findIndex(
        (el) => el.title == updatedCampaign.title
      );
      this.campaigns[index] = updatedCampaign;
      this.updateCampaignStatus(index);
    },
    changeCampaignStatus(updatedStatusCampaign) {
      const index = this.campaigns.findIndex(
        (el) => el.title == updatedStatusCampaign.title
      );
      this.campaigns[index] = {
        ...updatedStatusCampaign,
        status: updatedStatusCampaign.status,
      };

      this.campaigns[index].creatives.forEach(
        (creative) => (creative.status = updatedStatusCampaign.status)
      );
    },
    changeCreativeStatus(updatedStatusCreativeCampaign) {
      const index = this.campaigns.findIndex(
        (el) => el.title == updatedStatusCreativeCampaign.title
      );

      this.campaigns[index] = {
        ...updatedStatusCreativeCampaign,
      };

      this.updateCampaignStatus(index);
    },
    updateCampaignStatus(currentCampaignIndex) {
      const isAllDraft = this.campaigns[currentCampaignIndex].creatives.every(
        (creative) => creative.status == 0
      );

      const isAllFinished = this.campaigns[
        currentCampaignIndex
      ].creatives.every((creative) => creative.status == 2);

      const isAtleastOneLive = this.campaigns[
        currentCampaignIndex
      ].creatives.some((creative) => creative.status == 1);

      if (isAllDraft) {
        this.campaigns[currentCampaignIndex].status = 0;
      } else if (isAllFinished) {
        this.campaigns[currentCampaignIndex].status = 2;
      } else if (isAtleastOneLive) {
        this.campaigns[currentCampaignIndex].status = 1;
      }
    },
  },
  data() {
    return {
      dateSortWay: null,
      currentStatusFilter: "No filter",
      campaigns: [
        {
          title: "",
          start_date: null,
          status: 0,
          creatives: [
            {
              title: "",
              status: 0,
            },
          ],
        },
      ],
    };
  },
  computed: {
    filterCampaign() {
      let currentStatus = -1;
      if (this.currentStatusFilter == "Draft") currentStatus = 0;
      else if (this.currentStatusFilter == "Live") currentStatus = 1;
      else if (this.currentStatusFilter == "Finished") currentStatus = 2;
      else if (this.currentStatusFilter == "No filter") currentStatus = -1;

      if (currentStatus == -1) {
        return this.campaigns;
      } else {
        const newCampaigns = this.campaigns.filter(
          (campaign) => campaign.status === currentStatus
        );
        return newCampaigns;
      }
    },
  },
  created() {
    this.campaigns = [
      {
        title: "First Campaign",
        start_date: 1623277998930,
        status: 0,
        creatives: [
          {
            title: "Creative 1.1",
            status: 0,
          },
          {
            title: "Creative 1.2",
            status: 1,
          },
          {
            title: "Creative 1.3",
            status: 2,
          },
        ],
      },
      {
        title: "Second Campaign",
        start_date: 1523276887829,
        status: 1,
        creatives: [
          {
            title: "Creative 2.1",
            status: 0,
          },
          {
            title: "Creative 2.2",
            status: 1,
          },
          {
            title: "Creative 3.3",
            status: 2,
          },
        ],
      },
    ];
  },
};
</script>

<style></style>
