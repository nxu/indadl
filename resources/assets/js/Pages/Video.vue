<template>
  <Layout>
    <Card class="mt-8 sm:mt-32 relative">
      <InertiaLink href="/" class="absolute top-3 left-7 flex text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 fill-current"><path d="M229.9 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L94.569 282H436c6.627 0 12-5.373 12-12v-28c0-6.627-5.373-12-12-12H94.569l155.13-155.13c4.686-4.686 4.686-12.284 0-16.971L229.9 38.101c-4.686-4.686-12.284-4.686-16.971 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971L212.929 473.9c4.686 4.686 12.284 4.686 16.971-.001z"/></svg>
      </InertiaLink>

      <div class="flex justify-center mx-auto text-sm">
        <button v-for="res in resolutions"
                :class="`px-4 py-1 ${res == state.selectedResolution ? 'bg-indigo-400 pointer-events-none' : 'bg-indigo-600'}  hover:bg-indigo-700 active:bg-indigo-800 first-of-type:rounded-l-md last-of-type:rounded-r-md border-r border-r-indigo-800 last-of-type:border-r-0 text-white `"
                :disabled="res == state.selectedResolution"
                @click="state.selectedResolution = res"
        >
          {{ res }}p
        </button>
      </div>

      <div class="mt-12 text-center">
        <a :href="video.resolutions[state.selectedResolution]" target="_blank" download class="bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 px-4 py-2 text-white rounded">
          Letöltés
        </a>

        <hr class="my-6">

        <video class="mx-auto max-w-full" :src="video.resolutions[state.selectedResolution]" controls></video>
      </div>
    </Card>
  </Layout>
</template>

<script>
import Card from "../Components/Card";
import Layout from "../Components/Layout";
import {computed, reactive} from "vue";
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
  components: {
    Card,
    Layout,
    InertiaLink
  },

  props: {
    video: Object,
  },

  setup(props) {
    const resolutions = computed(() => {
      return Object.keys(props.video.resolutions)
        .filter((res) => !! props.video.resolutions[res]);
    });

    const allResolutions = Object.keys(props.video.resolutions)
        .filter((res) => !! props.video.resolutions[res]);

    const state = reactive({
      selectedResolution: allResolutions[allResolutions.length - 1],
    });

    return { resolutions, state };
  }
}
</script>
