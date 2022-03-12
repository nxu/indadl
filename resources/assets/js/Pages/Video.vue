<template>
  <Layout>
    <Card class="mt-32">
      Fe
    </Card>
  </Layout>
</template>

<script>
import Card from "../Components/Card";
import Layout from "../Components/Layout";
import {computed} from "vue";

export default {
  components: {
    Card,
    Layout,
  },

  props: {
    video: Object,
  },

  setup(props) {
    const resolutions = computed(() => {
      return Object.keys(props.video.resolutions)
        .filter((res) => !! props.video.resolutions[res]);
    });

    return { resolutions };
  }
}
</script>
