<template>
  <Layout :hide-footer="true">
    <div>
      <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 -mt-6 w-full sm:w-3/4 lg:w-1/2 2xl:w-1/3 px-4">
        <h1 class="text-center mb-8 text-4xl font-bold font-serif">
          Indavideó letöltés
        </h1>

        <form class="bg-white shadow rounded-lg flex" @submit.prevent="submit">
          <input type="text"
                 name="url"
                 class="rounded-l-lg pl-4 py-3 flex-grow"
                 placeholder="Indavideó link"
                 v-model="form.url"
                 autofocus
                 required
          >

          <button type="submit" class="rounded-r-lg px-4 py-3 bg-indigo-500 text-white hover:bg-indigo-600 active:bg-indigo-700">
            Letöltés
          </button>
        </form>
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
