<template>
  <div>
    <!-- <button @click="sortCampaign(true)" class="btn btn-primary">
      Sort campaigns by date
    </button> -->
    <div class="form-group col-lg-3 my-4">
      <label for="exampleSelect1" class="form-label mt-4">Sort campaings</label>
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
    <div v-for="singleCampaign in campaigns" :key="singleCampaign.title">
      <Campaign :campaign="singleCampaign" />
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

      const newCampaigns = this.campaigns.sort((a, b) =>
        newestToLatest
          ? new Date(a.start_date) - new Date(b.start_date)
          : new Date(b.start_date) - new Date(a.start_date)
      );
      console.log(newCampaigns);
    },
  },
  data() {
    return {
      dateSortWay: null,
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
        start_date: 1623276887829,
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

<style>
</style>
