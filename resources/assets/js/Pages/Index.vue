<template>
  <Layout :hide-footer="true">
    <div>
      <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 -mt-6 w-full sm:w-3/4 lg:w-1/2 2xl:w-1/3 px-4">
        <h1 class="text-center mb-8 text-4xl font-bold font-serif dark:text-gray-300">
          😔
        </h1>

        <div class="bg-white dark:bg-gray-800 dark:text-gray-100 shadow rounded-lg p-8 border border-gray-50 dark:border-none" @submit.prevent="submit">
          <p>
            A letöltő jelenleg sajnos nem működik.
            <br>
            A részleteket lásd itt:
            <a class="underline" href="https://github.com/nxu/indadl/issues/56">https://github.com/nxu/indadl/issues/56</a>
          </p>
        </div>
      </div>

      <Footer class="absolute bottom-5 w-full"></Footer>
    </div>
  </Layout>
</template>

<script>
import Footer from '../Components/Footer'
import Layout from '../Components/Layout'
import {Inertia} from "@inertiajs/inertia";
import {reactive} from "vue";

export default {
  components: { Footer, Layout },

  setup() {
    const form = reactive({
      url: null
    });

    function submit() {
      Inertia.post('/', form);
    }

    return {form, submit};
  }
}
</script>
